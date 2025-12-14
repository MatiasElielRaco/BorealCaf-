import path from 'path';
import fs from 'fs';
import { glob } from 'glob';
import { src, dest, watch, series, parallel } from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import terser from 'gulp-terser';
import sharp from 'sharp';
import browserSync from 'browser-sync';
import concat from 'gulp-concat';
import rename from 'gulp-rename';
import webpack from 'webpack-stream';

const sass = gulpSass(dartSass);
const server = browserSync.create();

/* ------------------------------
   JS: concat + minify
--------------------------------*/
export function js(done) {
  src('src/js/**/*.js')
    .pipe(webpack({
      mode: 'production',
    }))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/build/js'))
    .pipe(server.stream());
  done();
}

/* ------------------------------
   CSS: Sass → CSS comprimido
--------------------------------*/
export function css(done) {
  src('src/scss/app.scss', { sourcemaps: true })
    .pipe(
      sass({ style: 'compressed' }).on('error', sass.logError)
    )
    .pipe(rename({ basename: 'app', suffix: '.min' })) // app.min.css
    .pipe(dest('public/build/css', { sourcemaps: '.' }))
    .pipe(server.stream());
  done();
}

/* ------------------------------
   Imágenes: jpg + webp + avif
--------------------------------*/
export async function imagenes(done) {
  const srcDir = './src/img';
  const buildDir = 'public/build/img';
  const images = await glob('./src/img/**/*.{jpg,png}');

  for (const file of images) {
    const relativePath = path.relative(srcDir, path.dirname(file));
    const outputSubDir = path.join(buildDir, relativePath);
    await procesarImagenes(file, outputSubDir);
  }

  server.reload();
  done();
}

async function procesarImagenes(file, outputSubDir) {
  if (!fs.existsSync(outputSubDir)) {
    fs.mkdirSync(outputSubDir, { recursive: true });
  }

  const baseName = path.basename(file, path.extname(file));

  const outputJpg  = path.join(outputSubDir, `${baseName}.jpg`);
  const outputWebp = path.join(outputSubDir, `${baseName}.webp`);
  const outputAvif = path.join(outputSubDir, `${baseName}.avif`);

  const options = { quality: 80 };

  await sharp(file).jpeg(options).toFile(outputJpg);
  await sharp(file).webp(options).toFile(outputWebp);
  await sharp(file).avif({ quality: 50 }).toFile(outputAvif);
}


export function dev() {
  watch('src/scss/**/*.scss', css);
  watch('src/js/**/*.js', js);
  watch('src/img/**/*.{jpg,png}', imagenes);
  watch('public/**/*.{html,php}').on('change', server.reload);
}

/* ------------------------------
   Tareas públicas
--------------------------------*/
export const build = parallel(css, js, imagenes);
export default series(build, dev);
