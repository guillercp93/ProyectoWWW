<?php
require_once '../modelo/Cita_Modelo.php';
if ($_SESSION["idPerfil"] == 1) {
	/* BUSCAMOS EVENTOS */
	$citaModelo = new Citas_Modelo();
	$query_eventos=$citaModelo->mostrarCitas("cedMedico", $_SESSION["cedula"]);
?>
	<div class="escritorio">
		<input type="hidden" id="p" value="1">
		<div class="calendar" data-color="normal">
		<?php
		if ($eventos=mysqli_fetch_assoc($query_eventos))
		{
			do
			{
			?>
			<div data-role="day" data-day="<?php $fecha=explode("-",$eventos['fecha']); echo $fecha[0].intval($fecha[1]).intval($fecha[2]); ?>">
				<div data-role="event" data-idevento="<?php echo $eventos['idCita']; ?>" data-name="<?php echo "Cédula Paciente:".utf8_encode($eventos["idPaciente"]); ?>"></div>
			</div>
			<?php
			}
			while($eventos=mysqli_fetch_assoc($query_eventos));
		}
		?>
		</div>
	</div>
	<script>
	var yy;
	var calendarArray =[];
	var monthOffset = [6,7,8,9,10,11,0,1,2,3,4,5];
	var monthArray = [["ENE","Enero"],["FEB","Febrero"],["MAR","Marzo"],["ABR","Abril"],["MAY","Mayo"],["JUN","Junio"],["JUL","Julio"],["AGO","Agosto"],["SEP","Septiembre"],["OCT","Octubre"],["NOV","Noviembre"],["DIC","Diciembre"]];
	var letrasArray = ["L","M","X","J","V","S","D"];
	var dayArray = ["7","1","2","3","4","5","6"];
	$(document).ready(function() 
	{
		$(document).on('click','.calendar-day.have-events',activateDay);
		$(document).on('click','.specific-day',activatecalendar);
		$(document).on('click','.calendar-month-view-arrow',offsetcalendar);
		$(window).resize(calendarScale);
		calendarSet();
		calendarScale();
		
		
		$('body').on('click', '.colorbox', function(e) 
		{
			e.preventDefault();
			$.colorbox({href:$(this).attr('href'), open:true,iframe:true,innerWidth:"600px",innerHeight:"415px",overlayClose:false});
			return false;
		});
		
		
		
	});
	</script>
<?php
}
?>