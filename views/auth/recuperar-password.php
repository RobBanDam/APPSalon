<h1 class="nombre-pagina">Recupera tu Contraseña</h1>
<p class="descripcion-pagina">Coloca tu Nueva Contraseña a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if($error) return; ?>
<form class="formulario" method="post">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Ingresa la nueva contraseña">
    </div>
    <input type="submit" value="Guardar Nueva Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>