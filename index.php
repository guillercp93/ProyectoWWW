<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link href='http://fonts.googleapis.com/css?family=Oxygen&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href="css/calendar.min.css" rel="stylesheet">
	<link href="css/colorbox.css" rel="stylesheet">
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/calendar.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	<title>Gestor de Citas</title>
</head>
<body>
	<div id="contenedor">
		<form id="form1" onsubmit="cargarAjax('controlador/Usuario_Control.php', 'contenedor'); return false;">
			<h1>Inicio de Sesión</h1>
			<input type="text" name="cedula" placeholder="Digite su cédula" maxlength="20" pattern="^[0-9]{1,10}" autofocus required>
			<br>
			<input type="password" name="contrasenia" placeholder="Digite su contraseña" maxlength="15" pattern="[A-Za-z0-9]{6,15}" required>
			<br>
			<input type="submit" value="Entrar">
		</form>
	</div>
</body>
</html>