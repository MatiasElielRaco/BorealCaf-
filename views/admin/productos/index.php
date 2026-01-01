<h1 class="dashboard__headings"><?php echo $titulo ?></h1>

    <form method="GET" action="/admin/productos" class="filtros">
        <div class="filtros__group">
            <label for="search">Buscar</label>
            <input 
                type="text" 
                id="search" 
                name="search" 
                placeholder="Nombre del producto..." 
                value="<?php echo isset($filtros['search']) ? htmlspecialchars($filtros['search']) : ''; ?>"
            >
        </div>
        <div class="filtros__group">
            <label for="categoria">Categoría</label>
            <select name="categoria" id="categoria">
                <option value="">Todas</option>
                <?php foreach($categorias as $cat): ?>
                    <option value="<?php echo $cat->id; ?>" <?php echo (isset($filtros['categoria']) && $filtros['categoria'] == $cat->id) ? 'selected' : ''; ?>>
                        <?php echo $cat->nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filtros__group">
            <label for="disponible">Disponibilidad</label>
            <select name="disponible" id="disponible">
                <option value="">Todas</option>
                <option value="1" <?php echo (isset($filtros['disponible']) && $filtros['disponible'] == 1) ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo (isset($filtros['disponible']) && $filtros['disponible'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div class="filtros__botones">
            <button type="submit" class="filtros__botones--boton">Filtrar</button>
    
            <?php if(!empty($filtros)): ?>
                <a href="/admin/productos" class="filtros__botones--boton">Limpiar</a>
            <?php endif; ?>
    
            <a href="/admin/productos/crear" class="filtros__botones--boton"><strong>&plus;</strong>Nuevo Producto</a>
        </div>
    </form>

<main class="productos">

    <table class="tabla">
        <thead class="tabla__thead">
            <tr>
                <th class="tabla__th">Nombre</th>
                <th class="tabla__th">Categoria</th>
                <th class="tabla__th">Precio</th>
                <th class="tabla__th">Disponible</th>
                <th class="tabla__th">Acciones</th>
            </tr>
        </thead>
        <tbody class="tabla__tbody">
            <?php foreach($productos as $producto) { ?>
                <tr class="tabla__tr">
                    <td class="tabla__td" data-label="Nombre"><?php echo $producto->nombre; ?></td>
                    <td class="tabla__td" data-label="Categoria">
                        <?php foreach($categorias as $categoria): ?>
                            <?php if($producto->categoria_id === $categoria->id) echo $categoria->nombre; ?>
                        <?php endforeach; ?>
                    </td>
                    <td class="tabla__td" data-label="Precio">$<?php echo number_format($producto->precio, 2, ',', '.'); ?></td>
                    <td class="tabla__td" data-label="Disponible"><?php echo $producto->disponible ? 'Sí' : 'No'; ?></td>
                    <td class="tabla__td tabla__acciones">
                        <div class="tabla__acciones--inner">
                            <a href="/admin/productos/editar?id=<?php echo $producto->id; ?>" class="tabla__accion tabla__accion--editar">Editar</a>
                            <form action="/admin/productos/eliminar" method="POST" class="tabla__formulario-eliminar">
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                <button type="submit" class="tabla__accion tabla__accion--eliminar">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo $paginacion; ?>

</main>
