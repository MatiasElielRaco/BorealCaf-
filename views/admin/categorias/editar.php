<h1 class="dashbard__headings"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a href="/admin/categorias" class="dashboard__contenedor-boton--enlace"><strong>&xlarr;</strong>Volver</a>
</div>

<div class="dashboard__formulario">

    <?php 
        include_once __DIR__ . '/../../templates/alertas.php'; 
    ?>

    <form action="" enctype="multipart/form-data" method="POST" class="formulario">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Editar Categoria" class="formulario__submit">
    </form>
    
</div>