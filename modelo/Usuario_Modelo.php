	<?php

require_once("BaseDatos.php");

/**
* 
*/
class Usuario_Modelo
{
	private $cedula;
	private $nombre;
	private $apellido;
	private $email;	
	private $idPerfil;
	private $direccion;
	private $fechaNacimiento;
	private $contrasenia;
	private $bd;

	public function Usuario_Modelo()
	{
		$this->bd = new BaseDatos_Modelo();
	}

	public function existeUsuarioBD($cedula)
	{
		$this->bd->conectar();
		
		if($this->bd->ejecutar("SELECT * FROM usuarios WHERE cedula = '".$cedula."'"))
		{
			return true;
		}else
		{
			return false;
		}

		$this->bd->desconectar();
	}

	public function crearUsuario($datos)
	{
		$this->bd->conectar();
		$consulta = $this->bd->ejecutar("INSERT INTO usuarios VALUES ('".$datos['cedula']."', '".$datos['perfil']."', 
			'".$datos['nombre']."', '".$datos['apellido']."', '".$datos['nacimiento']."','".$datos['direccion']."',
			'".$datos['email']."','".$datos['contrasenia']."');");

		if($datos['perfil'] == "1")
		{
			$this->bd->ejecutar("INSERT INTO medico VALUES ('".$datos['cedula']."', '".$datos['especialidad']."', '
				".$datos['horainicio']."', '".$datos['horafinal']."')");
		}

		$this->bd->desconectar();

		if($consulta)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function editarUsuarioBD($parametros, $datos)
	{
		$this->bd->conectar();
		if ($parametros == null) {
			$this->bd->ejecutar("UPDATE usuarios SET nombre='".$datos['nombre']."', 
				apellido='".$datos['apellido']."', fechaNacimiento='".$datos['nacimiento']."', 
				direccion='".$datos['direccion']."', email='".$datos['email']."' WHERE cedula='".$datos['cedula']."'");
		}

		if($parametros == "contrasenia"){
			$this->bd->ejecutar("UPDATE usuarios SET contrasenia='".$datos[1]."' WHERE contrasenia='".$datos[0]."'");
		}

		$this->bd->desconectar();
		
	}

	public function consultarDatosBD($valor)
	{
		$this->bd->conectar();
		$this->bd->ejecutar("SELECT * FROM usuarios WHERE cedula = '".$valor."'");

		$row = $this->bd->getDatos();
		$this->bd->desconectar();

		if($row)
		{
			$this->cedula = $row["cedula"];
			$this->nombre = $row["nombre"];
			$this->apellido = $row["apellido"];
			$this->direccion = $row["direccion"];
			$this->fechaNacimiento = $row["fechaNacimiento"];
			$this->email = $row["email"];
			$this->contrasenia = $row["contrasenia"];
			$this->idPerfil = $row["idPerfil"];

			return true;
		}else
		{
			return false;
		}
	}

	public function getDatosUsuario()
	{
		$datos = array($this->cedula,//0
						$this->nombre,//1
						$this->apellido,//2
						$this->direccion,//3
						$this->fechaNacimiento,//4
						$this->email,//5
						$this->idPerfil,//6
						$this->contrasenia//7
					);

		return $datos;
	}


}

?>