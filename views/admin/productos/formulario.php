<div class="formulario__campo">
    <label for="nombre" class="formulario__label">Producto</label>
    <input 
    type="text" 
    id="nombre" 
    name="nombre" 
    class="formulario__input" 
    placeholder="Producto" 
    value="<?php echo s($producto->nombre); ?>"
    />
</div>

<div class="formulario__campo">
    <label for="descripcion" class="formulario__label">Descripción</label>
    <textarea 
        id="descripcion" 
        name="descripcion" 
        class="formulario__input formulario__input--textarea" 
        placeholder="Descripción del Producto"
    ><?php echo s($producto->descripcion); ?></textarea>
</div>

<div class="formulario__campo">
    <label for="categoria" class="formulario__label">Categoría</label>
    <select 
        id="categoria" 
        name="categoria_id" 
        class="formulario__input"
    >
        <option value="" disabled selected>-- Seleccione --</option>
        <?php foreach($categorias as $categoria): ?>
            <option 
                <?php echo $producto->categoria_id === $categoria->id ? 'selected' : ''; ?> 
                value="<?php echo s($categoria->id); ?>"
            >
                <?php echo s($categoria->nombre); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="formulario__campo">
    <label for="precio" class="formulario__label">Precio</label>
    <input 
        type="number" 
        id="precio" 
        name="precio" 
        class="formulario__input" 
        placeholder="Precio del Producto" 
        value="<?php echo s($producto->precio); ?>"
    />
</div>

<div class="formulario__campo">
    <label for="imagen" class="formulario__label">Imagen</label>
    <input 
        type="file" 
        id="imagen" 
        name="imagen" 
        class="formulario__input" 
        accept="image/jpeg, image/png"
    />
</div>

    <?php if(isset($producto->imagen_actual)): ?>
        <p class="formulario__texto">Imagen Actual</p>
        <div class="formulario__imagen">

            <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->imagen; ?>.png" alt="Imagen Producto" class="formulario__imagen--img">
            </picture>
            
        </div>
    <?php endif; ?>

<div class="formulario__campo">
    <label for="disponible" class="formulario__label">Disponible</label>
    <select 
        id="disponible" 
        name="disponible" 
        class="formulario__input"
    >
        <option value="1" <?php echo $producto->disponible === "1" ? 'selected' : ''; ?>>Sí</option>
        <option value="0" <?php echo $producto->disponible === "0" ? 'selected' : ''; ?>>No</option>
    </select>
</div>

