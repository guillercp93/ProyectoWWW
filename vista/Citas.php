<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		<link href="../css/calendar.min.css" rel="stylesheet">
		<script type="text/javascript" src="../js/ajax.js"></script>
	</head>
	<body>
		<div id="ventanaForm">
		<?php 
		require_once '../modelo/BaseDatos.php';
		require_once '../modelo/Cita_Modelo.php';
		session_start();

		function fecha($fecha,$forma)
		{
			$trim=explode("-",$fecha);
			if (intval($trim[2])<10) $trim[2]="0".$trim[2];
			if ($forma=="es") return $trim[2]."-".$trim[1]."-".$trim[0];
			elseif ($forma=="en") return $trim[0]."-".$trim[1]."-".$trim[2];
		}

		if($_GET["accion"] == "insertar")
		{
			echo "<h1>Cita Nueva".fecha($_GET["dia"],"es")."</h1>";

			if ($_SESSION["idPerfil"] == 2) {
				?>
				<form id="form4" onsubmit="gestionCitas('<?php echo $_GET['accion']; ?>'); parent.jQuery.colorbox.close();">
					<label>Cédula Paciente:</label><input type="text" name="cedulaP" pattern="^[0-9]{0,20}" required><br>
					<label>Hora inicio:</label><input type="time" name="horainicio" required><br>
					<label>Especialidad:</label><select name="especialidad" onchange="obtenerDoctor('../controlador/Usuario_Control.php');">
					<option>...</option>
					<?php
						$bd = new BaseDatos_Modelo();
						$bd->conectar();
						$consulta = $bd->ejecutar("SELECT * FROM especialidad");
						$bd->desconectar();	
						while ($datos = mysqli_fetch_assoc($consulta)) {
							?><option value="<?php echo $datos['id'];?>"><?php echo utf8_encode($datos['nombre']); ?></option><?php
						}
					?>
					</select>
					<br>
					<label>Doctor: </label><span name="divDoctor"></span><br>
					<input type="hidden" name="fecha" value="<?php echo fecha($_GET["dia"],"en"); ?>">
					<br>
					<input type="submit" value="<?php echo $_GET['accion']; ?> Cita">
				</form>
			<?php
			}
		}elseif ($_GET["accion"] == "editar") {
			$citaModelo = new Citas_Modelo();
			$res = mysqli_fetch_assoc($citaModelo->mostrarCitas("idCita", $_GET["idevento"]));
			if ($_SESSION["idPerfil"] == 1) {
				?>
				<form id="form4" onsubmit="gestionCitas('estado'); parent.jQuery.colorbox.close();">
					<label>Cédula Paciente:</label><input type="text" name="cedulaP" pattern="^[0-9]{0,20}" value="<?php echo $res["idPaciente"]; ?>" disabled="disabled"><br>
					<label>Hora inicio:</label><input type="time" name="horainicio" value="<?php echo $res['hora'] ?>" disabled="disabled"><br>
					<label>Estado:</label><select name="estado">
						<option value="atendida">Atendida</option>
						<option value="perdida">Perdida</option>
					</select>
					<input type="hidden" name="idCita" value="<?php echo $res['idCita']; ?>">
					<input type="hidden" name="fecha" value="<?php echo $res['fecha']; ?>">
					<br>
					<input type="submit" value="<?php echo $_GET['accion']; ?> Cita">
				</form>
				<?php
			} elseif ($_SESSION["idPerfil"] == 2) {
				?>
				<form id="form4" onsubmit="gestionCitas('<?php echo $_GET['accion']; ?>'); parent.jQuery.colorbox.close();">
					<label>Cédula Paciente:</label><input type="text" name="cedulaP" pattern="^[0-9]{0,20}" value="<?php echo $res["idPaciente"]; ?>" disabled="disabled"><br>
					<label>Hora inicio:</label><input type="time" name="horainicio" value="<?php echo $res['hora'] ?>" required><br>
					<label>Especialidad:</label><select name="especialidad" onchange="obtenerDoctor('../controlador/Usuario_Control.php');">
					<option>...</option>
					<?php
						$bd = new BaseDatos_Modelo();
						$bd->conectar();
						$consulta = $bd->ejecutar("SELECT * FROM especialidad");
						$bd->desconectar();	
						while ($datos = mysqli_fetch_assoc($consulta)) {
							?><option value="<?php echo $datos['id'];?>"><?php echo utf8_encode($datos['nombre']); ?></option><?php
						}
					?>
					</select>
					<br>
					<label>Doctor: </label><span name="divDoctor"></span><br>
					<label>Estado:</label><select name="estado">
						<option value="pendiente">Pendiente</option>
						<option value="cancelada">Cancelada</option>
					</select>
					<input type="hidden" name="idCita" value="<?php echo $res['idCita']; ?>">
					<input type="hidden" name="fecha" value="<?php echo $res['fecha']; ?>">
					<br>
					<input type="submit" value="<?php echo $_GET['accion']; ?> Cita">
				</form> <?php
			}
			
		}elseif ($_GET["accion"] == "eliminar") {
			$citaModelo = new Citas_Modelo();
			$res = mysqli_fetch_assoc($citaModelo->mostrarCitas("idCita", $_GET["idevento"]));
			?>
			<form id="form4">
				<label>¿Desea eliminar la cita del paciente <?php echo $_GET["idevento"];?>?</label><br>
				<input type="hidden" name="idCita" value="<?php echo $res['idCita']; ?>">
				<input type="submit" onclick="gestionCitas('<?php echo $_GET['accion'] ?>'); parent.jQuery.colorbox.close();" value="Si">
				<input type="button" onclick="parent.jQuery.colorbox.close();" value="No">
			</form>
			<?php
		}?>
		</div>
	</body>
</html>
