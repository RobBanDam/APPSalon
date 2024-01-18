<h1 class="nombre-pagina">Olvidé mi Contraseña</h1>
<p class="descripcion-pagina">Restablece tu Contraseña escribiendo tu e-mail a continuación</p>

<form class="formulario" action="/olvide" method="POST">

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu E-mail">
    </div>

    <input type="submit" value="Recupera tu Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>