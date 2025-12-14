<main class="auth">
    <h1 class="auth__heading"><?php echo $titulo; ?></h1>
    <p class="auth__texto">Crea tu cuenta en BorealCafé</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form action="/registro" method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                class="formulario__input" 
                placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text" 
                id="apellido" 
                name="apellido" 
                class="formulario__input" 
                placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="formulario__input" 
                placeholder="Tu Email"
                value="<?php echo s($usuario->email); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="formulario__input" 
                placeholder="Tu Contraseña"
            >
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input 
                type="password" 
                id="password2" 
                name="password2" 
                class="formulario__input" 
                placeholder="Repite tu Contraseña"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>