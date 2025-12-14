<div class="formulario__campo">
    <label for="nombre" class="formulario__label">Categoria</label>
    <input 
        type="text" 
        id="nombre" 
        name="nombre" 
        class="formulario__input" 
        placeholder="Nombre de la Categoría" 
        value="<?php echo s($categoria->nombre); ?>"
    />
</div>
