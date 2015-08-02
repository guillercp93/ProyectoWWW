<?php
@session_start();

if($_SESSION["idPerfil"] != 0)
{
	echo "<span class='error'>No tiene permiso para acceder</span>";
}else
{ ?>
	
	<div id="escritorio">
		<h2>¡Bienvenido!</h2>
		<p>¿Qué es lo que desea hacer?</p>
		<img src="img/usuarios.png">
		<img src="img/perfil.png">
		<img src="img/reporte.png">
		<br>
		<select id="listU" onchange="cargarOpcion('listU');">
			<option >elija opción en usuarios</option>
			<option value="u1">Crear Usuario</option>  
		</select>
		<select id="listP" onchange="cargarOpcion('listP');">
			<option>elija opción en especialidades</option>
		   <optgroup label="Especialidad">
		   		<option value="p4">Crear Especialidad</option>
		   		<option value="p5">Editar Especialidad</option>
		   		<option value="p6">Eliminar Especialidad</option>
		   </optgroup>
		</select>
		<select id="listR" onchange="cargarOpcion('listR');">
			<option>elija opción en reportes</option>
			<option value="r1">Reporte por doctor</option>
			<option value="r2">Reporte por especialidad</option>
			<option value="r3">Reporte por todo</option>
		</select>
	</div>

	<?php }
?>