<?php
	@session_start();

	if ($_SESSION["idPerfil"] != 0) {
		echo "<span class='error'>No tiene permiso para acceder</span>";
	}else
	{ ?>
		<form id="form3" onsubmit="cargarAjax('controlador/Especialidad_Control.php', 'escritorio'); return false;"><br>
			<h1>Editar Especialidad</h1>
			<input type="hidden" name="flag" value="1">
			<?php 
			require_once "../modelo/BaseDatos.php";

			$bd = new BaseDatos_Modelo();
			$bd->conectar();
			$consulta = $bd->ejecutar("SELECT * FROM especialidad");
			$bd->desconectar();	
			echo "<select name='oldEspecialidad'>";
			while ($datos = mysqli_fetch_assoc($consulta)) {
				echo "<option value='".$datos['id']."'>".utf8_encode($datos["nombre"])."</option>";
			}
			echo "</select>";
		?><br>
			<input placeholder="Nombre nueva especialidad" autofocus type="text" name="newEspecialidad" required><br>
			<input type="submit" value="Editar">
		</form>
<?php	
	}

?>