<script type="text/javascript">
	function fechaTop (){
		var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		var f=new Date();
		document.getElementById("fecha").innerText = f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	}

	window.onload=fechaTop();
</script>
<footer>
Creado por: Guillermo Castillo<br>
<a onclick="cargarAjax('vista/documentacion.php', 'escritorio');"><strong>Documentación</strong></a><br>
Universidad del Valle<br>
Tuluá, 2014
</footer>