<?php
	@session_start();
	require_once '../controlador/Usuario_Control.php';

	if (!isset($_SESSION)) {
		echo "<span class='error'>Inicie Sesión primero</span>";
	}else
	{ 
		$usuControl = new Usuario_Control();
		$datos = $usuControl->consultarUsuario($_SESSION["cedula"]);  
	?>
		<form id="form4" onsubmit="cargarAjax('controlador/Usuario_Control.php', 'escritorio'); return false;"><br>
			<h1>Editar Cuenta</h1>
			<input type="hidden" name="flag" value="1">
			<input placeholder="C&eacute;dula" autofocus type="text" name="cc" disabled="disable" pattern="[0-9]{1,20}" value="<?php echo $datos[0]; ?>"><br>
			<input placeholder="Nombre" type="text" name="nombre" required pattern="[A-Za-z &aacute&eacute&iacute&oacute&uacute&ntilde]{1,20}" value="<?php echo utf8_encode($datos[1]); ?>"><br>
			<input placeholder="Apellido" type="text" name="apellido" required pattern="[A-Za-z &aacute&eacute&iacute&oacute&uacute&ntilde]{1,20}" value="<?php echo utf8_encode($datos[2]); ?>"><br>
		 	<input type="date" name="nacimiento" value="<?php echo utf8_encode($datos[4]); ?>" required placeholder="DD/MM/AAAA"><br>
			<input placeholder="Direcci&oacute;n"    type="text" name="direccion" value="<?php echo $datos[3]; ?>"><br>
			<input placeholder="E-mail"   type="email" name="email" required value="<?php echo $datos[5]; ?>"><br>
			<input type="submit" name="btn" value="Editar">
			<?php
			if($_SESSION["idPerfil"] == 0){
				?><input type="button" value="volver" onclick="cargarAjax('vista/administrador.php', 'escritorio')"><?php ;
			}
			else {if($_SESSION["idPerfil"] == 1){
				?><input type="button" value="volver" onclick="cargarAjax('vista/medico.php', 'escritorio')"><?php ;
				}else {if ($_SESSION["idPerfil"] == 2)
					?><input type="button" value="volver" onclick="cargarAjax('vista/auxiliar.php', 'escritorio')">
		</form>		
<?php ;	}}
	}

?>