<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
        <?php 
            require_once __DIR__ . "/../templates/alertas.php";
        ?>
        
        <?php if($token_valido) : ?>
        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Contraseña</label>
                <input 
                    type="password"
                    class="formulario__input"
                    placeholder="Tu Contraseña"
                    id="password"
                    name="password"
                />
            </div>
            <div class="formulario__campo">
                <label for="password2" class="formulario__label">Repetir Contraseña</label>
                <input 
                    type="password"
                    class="formulario__input"
                    placeholder="Repetir Contraseña"
                    id="password2"
                    name="password2"
                />
            </div>
                <input 
                    type="submit" 
                    class="formulario__submit"
                    value="Guardar Cambios"
                />
        </form>
        <?php endif ?>
        <div class="acciones">
            <a class="acciones__enlace" href="/login">Iniciar Sesión</a>
            <a class="acciones__enlace" href="/registro">¿No tenes cuenta? Creála</a>
        </div>

</main>