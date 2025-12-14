<h1 class="dashbard__headings"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a href="/admin/productos" class="dashboard__contenedor-boton--enlace"><strong>&xlarr;</strong>Volver</a>
</div>

<div class="dashboard__formulario">

    <?php 
        include_once __DIR__ . '/../../templates/alertas.php'; 
    ?>

    <form action="/admin/productos/crear" enctype="multipart/form-data" method="POST" class="formulario">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Crear Producto" class="formulario__submit formulario__submit">

    </form>
    
</div>