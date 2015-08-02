<?php
	@session_start();

	if ($_SESSION["idPerfil"] != 0) {
		echo "<span class='error'>No tiene permiso para acceder</span>";
	}else
	{ ?>
		<form id="form3" onsubmit="cargarAjax('controlador/Especialidad_Control.php', 'escritorio'); return false;"><br>
			<h1>Eliminar Especialidad</h1>
			<input type="hidden" name="flag" value="2">
			<?php 
			require_once "../modelo/BaseDatos.php";

			$bd = new BaseDatos_Modelo();
			$bd->conectar();
			$consulta = $bd->ejecutar("SELECT * FROM especialidad");
			$bd->desconectar();	
			echo "<select name='especialidad'>";
			while ($datos = mysqli_fetch_assoc($consulta)) {
				echo "<option value='".$datos['id']."'>".utf8_encode($datos["nombre"])."</option>";
			}
		?><br>
			<input type="submit" value="Eliminar">
		</form>
<?php	
	}

?>