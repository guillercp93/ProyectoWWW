<?php
	@session_start();

	if ($_SESSION["idPerfil"] != 0) {
		echo "<span class='error'>No tiene permiso para acceder</span>";
	}else
	{ ?>
		<form id="form6" onsubmit="cargarAjax('controlador/Reporte_Control.php', 'tabla'); return false;"><br>
			<h1>Reporte del Doctor</h1>
			<label>Especialidad: </label>
			<select name="especialidad" onchange="obtenerDoctor('controlador/Usuario_Control.php');">
				<option>...</option>
				<?php
					require_once '../modelo/BaseDatos.php';
					$bd = new BaseDatos_Modelo();
					$bd->conectar();
					$consulta = $bd->ejecutar("SELECT * FROM especialidad");
					$bd->desconectar();	
					while ($datos = mysqli_fetch_assoc($consulta)) {
						?><option value="<?php echo $datos['id'];?>"><?php echo utf8_encode($datos['nombre']); ?></option><?php
					}
				?>
			</select><br>
			<label>Doctor: </label><span name="divDoctor"></span><br>
			<input type="submit" value="Consultar">
			<?php
			if($_SESSION["idPerfil"] == 0){
				?><input type="button" value="volver" onclick="cargarAjax('vista/administrador.php', 'escritorio')"><?php ;
			}
			else {if($_SESSION["idPerfil"] == 1){
				?><input type="button" value="volver" onclick="cargarAjax('vista/medico.php', 'escritorio')"><?php ;
				}else {if ($_SESSION["idPerfil"] == 2)
					?><input type="button" value="volver" onclick="cargarAjax('vista/auxiliar.php', 'escritorio')"><?php ; }?>
		</form>
		<div id="tabla" align="center"></div>
<?php	
	}

?>