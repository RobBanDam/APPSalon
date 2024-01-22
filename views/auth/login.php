<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con Tus Datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form class="formulario" method="POST" action="/">
	<div class="campo">
		<label for="email">Email</label>
		<input type="email" id="email" placeholder="Ingresa tu email" name="email">
	</div>

	<div class="campo">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" placeholder="Ingresa tu Contraseña">
	</div>

	<input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
	<a href="/olvide">¿Olvidaste tu contraseña? Recupérala</a>
</div>