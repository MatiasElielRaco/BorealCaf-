<main class="auth">
    <h1 class="auth__heading"><?php echo $titulo; ?></h1>
    <p class="auth__texto">Recupera tu acceso a BorealCafé</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form action="/olvide" method="POST" class="formulario">
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

        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">
    </form>
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no teenes una cuenta? Registrate</a>
        <a href="/login" class="acciones__enlace">¿Ya teenes una cuenta? Inicia sesión</a>
    </div>
</main>