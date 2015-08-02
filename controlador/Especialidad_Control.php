<?php

require_once ('../modelo/Especialidad_Modelo.php');

/**
* 
*/
class Especialidad_Control
{
	private $espcModelo;
	
	public function Especialidad_Control()
	{
		$this->espcModelo = new Especialidad_Modelo();
	}

	public function crearEspecialidad()
	{
		

		if($this->espcModelo->crearEspecialidad($_POST))
		{
			return true;
		}else
		{
			return false;
		}

	}

	public function editarEspecialidad()
	{
		$this->espcModelo = new Especialidad_Modelo();

		if($this->espcModelo->editarEspecialidad($_POST))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function eliminarEspecialidad()
	{
		$this->espcModelo = new Especialidad_Modelo();
		$id = $_POST['espc'];
		if($this->espcModelo->eliminarEspecialidad($id))
		{
			return true;
		}else
		{
			return false;
		}
	}
}

$espcControl = new Especialidad_Control();

if(isset($_POST["flag"]))
{
	if ($_POST["flag"] == 0) 
	{
		if ($espcControl->crearEspecialidad()) {
			echo "<script type='text/javascript'>alert('La especialidad ha sido creada correctamente');</script>";
			include '../vista/administrador.php';
		}
	}else
	{
		if ($_POST["flag"] == 1) 
		{
			if ($espcControl->editarEspecialidad()) {
				echo "<script type='text/javascript'>alert('La especialidad ha sido editada correctamente');</script>";
				include '../vista/administrador.php';
			}
		}else
		{
			if ($_POST["flag"] == 2) 
			{
				if ($espcControl->eliminarEspecialidad()) {
					echo "<script type='text/javascript'>alert('La especialidad ha sido eliminada correctamente');</script>";
					include '../vista/administrador.php';
				}
			}
		}
	}
}
if(isset($_POST["esp"])){
	if($_POST["esp"] == "1")
	{
		require_once "../modelo/BaseDatos.php";

		$bd = new BaseDatos_Modelo();
		$bd->conectar();
		$consulta = $bd->ejecutar("SELECT * FROM especialidad");
		$bd->desconectar();	
		echo "<select name='especialidad'>";
		while ($datos = mysqli_fetch_assoc($consulta)) {
			echo "<option value='".$datos['id']."'>".utf8_encode($datos["nombre"])."</option>";
		}
		echo "</select><br>
				<label>Hora de inicio:</label><input type='time' name='horaInicio'><br>
				<label>Hora de final:</label><input type='time' name='horaFinal'>";
	}else
	{
		echo "<select name='especialidad'><option value='null'></option></select>";
	}
}
?>