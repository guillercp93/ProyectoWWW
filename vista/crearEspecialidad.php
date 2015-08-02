<?php
	@session_start();

	if ($_SESSION["idPerfil"] != 0) {
		echo "<span class='error'>No tiene permiso para acceder</span>";
	}else
	{ ?>
		<form id="form3" onsubmit="cargarAjax('controlador/Especialidad_Control.php', 'escritorio'); return false;"><br>
			<h1>Crear Especialidad</h1>
			<input type="hidden" name="flag" value="0">
			<input placeholder="Nombre especialidad" autofocus type="text" name="especialidad" required><br>
			<input type="submit" name="crear" value="Crear">
		</form>
<?php	
	}

?>