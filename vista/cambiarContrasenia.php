<?php
	@session_start();

	require_once ('../controlador/Usuario_Control.php');

	$usuControl = new Usuario_Control();
	$datos = $usuControl->consultarUsuario($_SESSION['cedula']);
?>
	<form id="form5" onsubmit="cargarAjax('controlador/Usuario_Control.php', 'escritorio'); return false;">
		<h1>Cambiar Contraseña</h1>
		<input type="hidden" name="oldContrasenia" value="<?php echo $datos[7]; ?>">
		<input type="password" name="nContrasenia" placeholder="Digite su nueva contraseña" maxlength="15" pattern="[A-Za-z0-9]{6,15}" required><br>
		<input type="password" name="cnContrasenia" placeholder="Confirme su nueva contraseña" maxlength="15" pattern="[A-Za-z0-9]{6,15}" required><br>
		<label id="msj"></label>
		<br><input type="submit" name="btn" value="Cambiar">
	</form>
