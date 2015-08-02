<?php

require_once ("BaseDatos.php");

/**
* 
*/
class Especialidad_Modelo
{
	private $id;
	private $nombre;
	private $bd;

	public function Especialidad_Modelo()
	{
		$this->bd = new BaseDatos_Modelo();
	}

	public function crearEspecialidad($datos)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("INSERT INTO especialidad (nombre) VALUES ('".$datos['espc']."');");
		$this->bd->desconectar();

		if($consulta)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function editarEspecialidad($datos)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("UPDATE especialidad SET nombre='".$datos['new']."' WHERE id='".$datos['old']."'");
		$this->bd->desconectar();
		if($consulta)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function eliminarEspecialidad($id)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("DELETE FROM especialidad WHERE id='".$id."'");
		$this->bd->desconectar();
		if($consulta)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function consultarEspecialidad($id)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("SELECT * FROM especialidad");
		$this->bd->desconectar();

		if($consulta)
		{
			return mysqli_fetch_array($consulta);
			
		}else
		{
			return false;
		}
	}
}

?>