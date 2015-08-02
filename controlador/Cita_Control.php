<?php

require_once '../modelo/Cita_Modelo.php';
/**
* 
*/
class Citas_Control
{
	private $citaModelo;

	public function Citas_Control()
	{
		$this->citaModelo = new Citas_Modelo();
	}
	
	public function crearCita()
	{
		
		if($this->citaModelo->crearCita($_POST))
		{
			return true;
		}else
		{
			return false;
		}
		
	}

	public function editarCitas()
	{
		if($this->citaModelo->editarCita($_POST))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function eliminarCitas()
	{
		if($this->citaModelo->eliminarCita($_POST['idCita']))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function editarEstado()
	{
		if($this->citaModelo->editarEstado($_POST['idCita'], $_POST['estado']))
		{
			return true;
		}else
		{
			return false;
		}
	}
}
	$citaControl = new Citas_Control();

	if (isset($_POST["accion"])) 
	{
		print_r($_POST);
		if ($_POST["accion"] == "insertar") 
		{
			if($citaControl->crearCita())
			{
				echo "Se ha creado la cita satisfactoriamente";
			}else{
				echo "imposible crear la cita";
			}
		}

		if ($_POST["accion"] == "editar") 
		{
			if($citaControl->editarCitas())
			{
				echo "Se ha editado la cita satisfactoriamente";
			}else{
				echo "imposible editar la cita";
			}
		}

		if ($_POST["accion"] == "eliminar") 
		{
			if($citaControl->eliminarCitas())
			{
				echo "Se ha eliminado la cita satisfactoriamente";
			}else{
				echo "imposible eliminar la cita";
			}
		}

		if ($_POST["accion"] == "estado") 
		{
			if($citaControl->editarEstado())
			{
				echo "Se ha editado la cita satisfactoriamente";
			}else{
				echo "imposible editar la cita";
			}
		}
	}else
	{
		echo "error!";
	}

?>