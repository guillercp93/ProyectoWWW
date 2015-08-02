<?php
	@session_start();

	if ($_SESSION["idPerfil"] != 0) {
		echo "<span class='error'>No tiene permiso para acceder</span>";
	}else
	{ ?>
		<form id="form2" onsubmit="cargarAjax('controlador/Usuario_Control.php', 'escritorio'); return false;"><br>
			<h1>Crear Usuario</h1>
			<input placeholder="C&eacute;dula" autofocus type="text" name="cc" required pattern="[0-9]{8,10}"><br>
			<input placeholder="Nombre" type="text" name="nombre" required pattern="[A-Za-z &aacute&eacute&iacute&oacute&uacute&ntilde]{1,20}"><br>
			<input placeholder="Apellido" type="text" name="apellido" required pattern="[A-Za-z &aacute&eacute&iacute&oacute&uacute&ntilde]{1,20}"><br>
		 	<input type="date" name="nacimiento" required placeholder="DD/MM/AAAA"><br>
			<input placeholder="Direcci&oacute;n"    type="text" name="direccion"><br>
			<input placeholder="E-mail"   type="email" name="email" required ><br>
			<input placeholder="Contrase&ntilde;a"  type="password" name="contrasenia" required pattern="[A-Za-z0-9]{6,15}"><br>
			<select name="perfil" onchange="obtenerEspecialidad();" >
				<option value="">Perfil:</option>
				<option value="1">Médico</option>
				<option value="2">Auxiliar</option>
			</select>
			<br>
			<span name="divEsp"></span><br>
			<input type="submit" name="btn" value="Crear">
		</form>
<?php	
	}

?>