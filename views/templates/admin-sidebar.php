<aside class="sidebar">
    <nav class="sidebar__menu" id="sidebar-menu">
        <a href="/admin/dashboard" class="sidebar__enlace <?php echo pagina_actual("/dashboard") ? "sidebar__enlace--activo" : "" ?>">Inicio</a>
        <a href="/admin/productos" class="sidebar__enlace <?php echo pagina_actual("/productos") ? "sidebar__enlace--activo" : "" ?>">Productos</a>
        <a href="/admin/categorias" class="sidebar__enlace <?php echo pagina_actual("/categorias") ? "sidebar__enlace--activo" : "" ?>">Categorías</a>
        <a href="/admin/pedidos" class="sidebar__enlace <?php echo pagina_actual("/pedidos") ? "sidebar__enlace--activo" : "" ?>">Pedidos</a>
        <a href="/admin/reportes" class="sidebar__enlace <?php echo pagina_actual("/reportes") ? "sidebar__enlace--activo" : "" ?>">Reportes</a>
    </nav>

    <form method="POST" action="/logout" class="sidebar__logout">
        <input type="submit" class="sidebar__logout--btn" value="Cerrar Sesión">
    </form>
</aside>