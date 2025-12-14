<main class="menu">

    <h1 class="menu__heading">Menú</h1>

    <div class="menu__grid">
        <?php foreach($platillos as $platillo) { ?>
            <div class="platillo">
                <picture>
                    <source srcset="build/img/<?php echo $platillo->imagen; ?>.webp" type="image/webp">
                    <source srcset="build/img/<?php echo $platillo->imagen; ?>.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/<?php echo $platillo->imagen; ?>.jpg" alt="Imagen platillo <?php echo $platillo->nombre; ?>">
                </picture>

                <div class="platillo__contenido">
                    <h3 class="platillo__nombre"><?php echo $platillo->nombre; ?></h3>
                    <p class="platillo__descripcion"><?php echo $platillo->descripcion; ?></p>
                    <p class="platillo__precio">$<?php echo $platillo->precio; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

</main>