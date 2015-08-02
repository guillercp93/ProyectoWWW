<?php 
require_once('BaseDatos.php');
/**
* 
*/
class Reporte_Modelo
{
	
	private $datos;
	private $bd;

	public function Reporte_Modelo()
	{
		$this->bd = new BaseDatos_Modelo();
	}

	public function reporte($idConsulta, $valor)
	{
		$this->bd->conectar();

		if ($idConsulta == "medico") {
			$this->datos=$this->bd->ejecutar("SELECT estado, count(estado) AS numero FROM citas WHERE cedMedico='".$valor."' GROUP BY estado");
		}else
		{
			if ($idConsulta == "especialidad") {
				$this->datos=$this->bd->ejecutar("SELECT estado, count(estado) AS numero FROM citas WHERE idEspecialidad='".$valor."' GROUP BY estado");
			}
		}

		$this->bd->desconectar();

		return $this->datos;
	}
}
 ?>