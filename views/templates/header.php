<header class="header">

    <div class="header__contenedor">
        <div class="header__logo-nombre">
            <img src="build/img/cafe.svg" alt="logo café" class="header__logo">
            <h1 class="header__titulo">BorealCafé</h1>
        </div>
    
        <nav class="navegacion">
            <a class="navegacion__link" href="/">Menú</a>
            <a class="navegacion__link" href="0">Sobre Nostros</a>
            <?php if(is_auth()) {  ?>
                <form method="POST" action="/logout" class="navegacion__link">
                    <input type="submit" value="Cerrar Sesión" class="navegacion__link--boton">
                </form>
                <?php } else { ?>
                    <a class="navegacion__link" href="/login">Iniciar Sesión</a>
                    <?php } ?>
            <?php if(is_admin()) :?>
                <a class="navegacion__link" href="/admin/dashboard">Administrar</a>
            <?php endif; ?>
        </nav>
    </div>


    <div class="hero">
        <div class="hero__contenido">
            <h2 class="hero__titulo">Hacé tu pedido online</h2>
            <p class="hero__texto">Disfruta de una experiencia única con nuestros granos seleccionados y métodos de preparación artesanales.</p>
            <a href="" class="hero__enlace">Ver Menú</a>
        </div>
        <picture>
            <source srcset="build/img/cafeinicio.avif" type="image/avif">
            <source srcset="build/img/cafeinicio.webp" type="image/webp">
            <img loading="lazy" src="build/img/cafeinicio.jpg" alt="Imagen café BorealCafé" class="hero__imagen">
        </picture>
    </div>
</header>