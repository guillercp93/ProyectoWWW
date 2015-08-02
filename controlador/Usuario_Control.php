<?php

require_once("../modelo/Usuario_Modelo.php");
/**
 * Unidad : Usuario_Control
 * Descripcion : Es controlador se encarga del inicio de sesion y de la gestion del usuario.
 *
**/

class Usuario_Control
{
	private $usuModelo;

	public function Usuario_Control() {
		$this->usuModelo = new Usuario_Modelo();
	}
	
	public function login($cedula, $contrasenia)
	{
		if ($this->usuModelo->existeUsuarioBD($cedula)) {
			
			$this->usuModelo->consultarDatosBD($cedula);
			$datos = $this->usuModelo->getDatosUsuario();
			
			if($datos[7] == $contrasenia)
			{
				$_SESSION["cedula"] = $datos[0];
				$_SESSION["nombre"] = $datos[1];
				$_SESSION["apellido"] = $datos[2];
				$_SESSION["idPerfil"] = $datos[6];

				return true;
			}

		}else
		{
			return false;
		}

	}

	public function cerrarSesion()
	{
		// Destruir todas las variables de sesión.
		$_SESSION = array();

		// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
		// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		// Finalmente, destruir la sesión.
		if(session_destroy())
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function crearCuenta($datos)
	{
		if ($this->usuModelo->crearUsuario($datos))
			return true;
		else
			return false;

	}

	public function modificarDatos($parametros, $datos)
	{
		if ($this->usuModelo->editarUsuarioBD($parametros, $datos))
			return true;
		else
			return false;
	}

	public function cambiarContrasenia($contrasenia, $nuevaContrasenia)
	{
		$datos = array($contrasenia,
						$nuevaContrasenia );
		if ($this->usuModelo->editarUsuarioBD("contrasenia", $datos))
			return true;
		else
			return false;
	}

	public function consultarUsuario($cedula)
	{
		if($this->usuModelo->consultarDatosBD($cedula))
			return $this->usuModelo->getDatosUsuario();
	}

}
@session_start();

$usuControl = new Usuario_Control();

if (isset($_POST["ced"]) && isset($_POST["pwd"])) {
	
	$cedula = $_POST["ced"];
	$contrasenia = $_POST["pwd"];
	
	if(is_numeric($cedula))
	{
		if (strlen($contrasenia) >= 6) 
		{
			$login = $usuControl->login($cedula, $contrasenia);
			if($login == true)
			{
				switch ($_SESSION["idPerfil"]) {
					case '0':
						require_once("../vista/header.php");
						require_once '../vista/administrador.php';
						require_once("../vista/footer.php");
						break;
					case '1':
						require_once("../vista/header.php");
						require_once '../vista/medico.php';
						require_once("../vista/footer.php");
						break;
					case '2':
						require_once("../vista/header.php");
						require_once '../vista/auxiliar.php';
						require_once("../vista/footer.php");
						break;
					default:
						# code...
						break;
				}
				
			}elseif ($login == false) {
				echo "<script type='text/javascript'>alert('El usuario no se encuentra registrado'); location.reload();</script>";
			}

		}else
		{
			echo "Los Campos son incorrectos, por favor llenarlos bien";
		}
	}else
	{
		echo "Los Campos son incorrectos, por favor llenarlos bien";
	}
}

if(isset($_POST["nombre"]) && isset($_POST["apellido"]))
{

	if($_POST["btn"] == "Crear")
	{
		$usuControl->crearCuenta($_POST);
		echo "<script type='text/javascript'>alert('Cuenta creada con éxito');</script>";
		require_once("../vista/administrador.php");
	}elseif ($_POST["btn"] == "Editar") 
	{
		$usuControl->modificarDatos(null, $_POST);
		echo "<script type='text/javascript'>alert('Sus datos personales fueron actualizados correctamente');</script>";
		if ($_SESSION["idPerfil"] == 0) {
			require_once("../vista/administrador.php");
		} else {
			if ($_SESSION["idPerfil"] == 1) {
				require_once("../vista/medico.php");
			} else {
				require_once("../vista/auxiliar.php");
			}
			
		}
		
	}else
		echo "<script type='text/javascript'>alert('ha ocurrido un error');</script>";

}

if(isset($_POST["sesion"])){
	if ($usuControl->cerrarSesion()) {
		echo "<script type='text/javascript'>location.href = 'index.php'</script>";
	
	}else
		echo "no se ha podido cerrar la sesión";
}

if(isset($_POST["esp"]))
{
	require_once "../modelo/BaseDatos.php";

	$bd = new BaseDatos_Modelo();
	$bd->conectar();
	$consulta = $bd->ejecutar("SELECT * FROM usuarios WHERE cedula IN (SELECT cedula FROM medico WHERE idEspecialidad='".$_POST["esp"]."')");
	$bd->desconectar();	
	echo "<select name='doctor'>";
	while ($datos = mysqli_fetch_assoc($consulta)) {
		echo "<option value='".$datos['cedula']."'>".$datos["nombre"]." ".$datos["apellido"]."</option>";
	}

	echo "</select>";
}

if (isset($_POST["nContrasenia"]) && isset($_POST["oldContrasenia"])) {

	$usuControl->cambiarContrasenia($_POST['oldContrasenia'], $_POST['nContrasenia']);
	if ($_SESSION["idPerfil"] == 0) {
		require_once("../vista/administrador.php");
	} else {
		if ($_SESSION["idPerfil"] == 1) {
			require_once("../vista/medico.php");
		} else {
			require_once("../vista/auxiliar.php");
		}
		
	}
}
?>