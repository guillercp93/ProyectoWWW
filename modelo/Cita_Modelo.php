<?php

require_once 'BaseDatos.php';

/**
* 
*/
class Citas_Modelo
{
	private $idCita;
	private $idPaciente;
	private $estado;
	private $cedDoctor;
	private $fecha;
	private $hora;
	private $bd;

	public function Citas_Modelo()
	{
		$this->bd = new BaseDatos_Modelo();
	}

	public function crearCita($datos)
	{
		$this->bd->conectar();
		$this->bd->ejecutar("SELECT * FROM citas WHERE (cedMedico='".$datos['doctor']."' AND fecha='".$datos['fecha']."') AND hora='".$datos['horaInicio']."'");
		if (!$this->bd->getDatos())
		{
			$this->bd->ejecutar("SELECT * FROM medico WHERE cedula='".$datos['doctor']."' AND (horaInicio <= '".$datos['horaInicio']."' AND horaFinal >= '".$datos['horaInicio']."')");
			if ($this->bd->getDatos())
			{
				$this->bd->ejecutar("INSERT INTO citas (idPaciente, idEspecialidad, cedMedico, fecha, hora, estado)
					VALUES ('".$datos['idPaciente']."', '".$datos['especialidad']."', '".$datos['doctor']."', '".$datos['fecha']."', '".$datos['horaInicio']."', '".$datos['estado']."')");

				return true;
			}else
			{
				return false;
			}
		}

		$this->bd->desconectar();
	}

	public function editarCita($datos)
	{
		$this->bd->conectar();
		$this->bd->ejecutar("SELECT * FROM citas WHERE ((cedMedico = '".$datos['doctor']."' AND fecha = '".$datos['fecha']."') 
			AND hora = '".$datos['horaInicio']."') AND idCita NOT IN (SELECT idCita FROM citas WHERE idCita = '".$datos['idCita']."')");
	
		if (!$this->bd->getDatos())
		{
			$this->bd->ejecutar("SELECT * FROM medico WHERE cedula='".$datos['doctor']."' AND (horaInicio <= '".$datos['horaInicio']."' AND horaFinal >= '".$datos['horaInicio']."')");
			if ($this->bd->getDatos())
			{
				$this->bd->ejecutar("UPDATE citas SET idEspecialidad = '".$datos['especialidad']."', cedMedico = '".$datos['doctor']."', fecha = '".$datos['fecha']."',
				hora = '".$datos['horaInicio']."', estado = '".$datos['estado']."' WHERE idPaciente = '".$datos['idPaciente']."'");

				return true;
			}else
			{
				return false;
			}
		}

		$this->bd->desconectar();
	}

	public function eliminarCita($idCita)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("DELETE FROM citas WHERE idCita='".$idCita."'");

		$this->bd->desconectar();

		if ($consulta) {
			return true;
		} else {
			return false;
		}
		
	}

	public function editarEstado($idCita, $estado)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("UPDATE citas SET estado = '".$estado."' WHERE idCita = '".$idCita."'");
		$this->bd->desconectar();

		if($consulta)
			return true;
		else
			return false;
	}

	public function mostrarCitas($campo, $valor)
	{
		$this->bd->conectar();

		if (!isset($campo) && !isset($valor)) {
			$consulta = $this->bd->ejecutar("SELECT * FROM citas WHERE 1 ORDER BY fecha ASC");
		} else {
			if ($campo == "cedMedico") {
				$consulta = $this->bd->ejecutar("SELECT * FROM citas WHERE ".$campo."='".$valor."' AND estado = 'pendiente' ORDER BY fecha ASC");
			} else {
				$consulta = $this->bd->ejecutar("SELECT * FROM citas WHERE ".$campo."='".$valor."' ORDER BY fecha ASC");
			}
		}
		
		$this->bd->desconectar();
		return $consulta;
	}
}

?>