<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente Formulario para Crear una Cuenta</p>

<form class="formulario" method="POST" action="/crear-cuenta">
    
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu Nombre" >
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu Apellido" >
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu Teléfono" >
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu E-mail" >
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu Password" >
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
	<a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
	<a href="/olvide">¿Olvidaste tu contraseña? Recupérala</a>
</div>