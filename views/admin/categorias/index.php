<h1 class="dashboard__headings"><?php echo $titulo ?></h1>

    <div class="dashboard__contenedor-boton">
        <a href="/admin/categorias/crear" class="dashboard__contenedor-boton--enlace"><strong>&plus;</strong>Nueva Categoria</a>
    </div>

<main class="categorias">

    <section class="categorias__grid">
        <?php foreach($categorias as $categoria): ?>
            <article class="categorias__categoria">
                <h4 class="categorias__titulo"><?php echo $categoria->nombre; ?></h4>
                <div class="categorias__acciones">
                    <div class="categorias__acciones--boton">
                        <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                        <button type="submit" class="categorias__acciones--eliminar">&times; Eliminar</button>
                    </div>
                    <a href="/admin/categorias/editar?id=<?php echo $categoria->id; ?>" class="categorias__acciones--editar"> Editar</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

</main>