<?php

class BaseDatos_Modelo{

    private $nombreBD;
    private $hostBD;
    private $usuarioBD;
    private $contrasenaBD;
    private $conexionBD;
    private $resultado;

	public function BaseDatos_Modelo(){
            
        $this->hostBD = "localhost";
    	$this->usuarioBD = "root";
    	$this->contrasenaBD = "";
    	$this->nombreBD = "proyectowww";

	}

	public function conectar(){

		$this->conexionBD = mysqli_connect($this->hostBD, $this->usuarioBD, $this->contrasenaBD, $this->nombreBD) or die("Problemas en la conexionBD: " + mysqli_connect_error());
		return $this->conexionBD;
	}

	public function desconectar(){

        mysqli_close($this->conexionBD);
	}

	public function ejecutar($query){
          
        $sql = $this->consulta = mysqli_query($this->conexionBD, $query) or die(mysqli_error($this->conexionBD));
        return $sql;
    }
             
	public function getDatos(){//Verificar uso del metodo
            
        $this->resultado = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC);
        mysqli_free_result($this->consulta);
        return $this->resultado;
	}
}

?>