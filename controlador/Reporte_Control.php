<?php
require_once '../modelo/Reporte_Modelo.php';
require_once("../dompdf/dompdf_config.inc.php");
/**
* 
*/
class Reporte_Control
{
	private $tabla;
	private $repModelo;

	public function Reporte_Control() {
		$this->tabla = "";
		$this->repModelo = new Reporte_Modelo();
	}
	
	public function consultaReporte($idConsulta, $valor)
	{
		$datos = array();
		$consulta = $this->repModelo->reporte($idConsulta, $valor);
		while ($row = mysqli_fetch_assoc($consulta)) {
			switch ($row['estado']) {
				case 'atendida':
					$datos[0] = $row['numero'];
					break;
				case 'cancelada':
					$datos[1] = $row['numero'];
					break;
				case 'perdida':
					$datos[2] = $row['numero'];
					break;				
				default:
					break;
			}
		}

		return $datos;


	}

	public function generarTabla($datos)
	{
		$this->tabla = "
			<table class='responstable'>
			<thead>
			    <tr>
			        <th scope='col' id='atendida'>Atendida</th>
			        <th scope='col' id='cancelada'>cancelada</th>
			        <th scope='col' id='Perdida'>Perdida</th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
					";
					for ($i=0; $i < 3; $i++) {
						if (isset($datos[$i])) {
						 	$this->tabla = $this->tabla."<td>".$datos[$i]."</td>";
						 } else {
						 	$this->tabla = $this->tabla."<td>0</td>";
						 }
					}
					$this->tabla =$this->tabla."
        		</tr>
        	</tbody>	
 			</table>";

 			echo $this->tabla."<a href='controlador/Reporte_Control.php?accion=1'><img src='img/pdficon.png'></a>
 			<a href='controlador/Reporte_Control.php?accion=2'><img src='img/xlsicon.png'></a>";
	}

	public function generarPDF()
	{
		$this->tabla = utf8_decode($this->tabla);
		$file = "<!DOCTYPE html>
				<html>
				<head>
					<meta charset='utf-8'>
				</head>
				<body>
					".$this->tabla."
				</body>
				</html>";
		$dompdf = new DOMPDF();
		$dompdf->set_paper("letter","landscape");  //tiene que ser horizontal y lo deja en vertical 
		$dompdf->load_html($file);  
		$dompdf->render(); 
		ini_set("memory_limit","32M");   
		$dompdf->stream("tabla.pdf");
	}

	public function generarXLS()
	{
		// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
		header("Content-type: application/vnd.ms-excel");
		//indicamos al navegador que se está devolviendo un archivo
		header("Content-Disposition: attachment; filename=figura1.xls");
		//con esto evitamos que el navegador lo grabe en su caché
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Description: PHP/INTERBASE Generated Data" );
		//damos salida a la tabla
		echo $this->tabla;
	}
}

$repControl = new Reporte_Control();

if(isset($_POST['idCons']) && isset($_POST['val'])){
	$datosbd = $repControl->consultaReporte($_POST['idCons'], $_POST['val']);
	$repControl->generarTabla($datosbd);
}

if (isset($_GET['accion'])) {
	if ($_GET['accion'] == 1) {
		$repControl->generarPDF();
	}else
	{
		$repControl->generarXLS();
	}
}


?>