function objetoAjax(){
	var xmlhttp=false;

	//para versiones anteriores de IE7
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	//para otros navegadores
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function SetContainerHTML(id,html,processScripts) {
console.error();
	if(document.getElementById(id)){
		mydiv = document.getElementById(id);
		
	}
	else{
		mydiv = document.getElementsByClassName(id)[0];
	}
	
	mydiv.innerHTML = html;

	if(processScripts!=false){
	    var elementos = mydiv.getElementsByTagName('script');
	    for(i=0;i<elementos.length;i++) {
	        var elemento = elementos[ i ];
	        nuevoScript = document.createElement('script');
	        nuevoScript.text = elemento.innerHTML;        
	        nuevoScript.type = 'text/javascript';
	        if(elemento.src!=null && elemento.src.length>0)
	            nuevoScript.src = elemento.src;
	        elemento.parentNode.replaceChild(nuevoScript,elemento);
	    }
	}
}

function cargarAjax (fuente, divID) {
	ajax = objetoAjax();

	if(document.getElementById('form1')){
		ced = document.getElementById("form1").cedula.value;
		pass = document.getElementById("form1").contrasenia.value;
	}

	if (document.getElementById('form2')) {
		cedula = document.getElementById('form2').cc.value;
		nombre = document.getElementById('form2').nombre.value;
		apellido = document.getElementById('form2').apellido.value;
		nacimiento = document.getElementById('form2').nacimiento.value;
		direccion = document.getElementById('form2').direccion.value;
		email = document.getElementById('form2').email.value;
		contrasenia = document.getElementById('form2').contrasenia.value;
		perfil = document.getElementById('form2').perfil.value;
		btn = document.getElementById('form2').btn.value;

		if(perfil=="1")
		{
			especialidad = document.getElementById('form2').especialidad.value;
			horainicio = document.getElementById('form2').horaInicio.value;
			horafinal = document.getElementById('form2').horaFinal.value;
		}
	}

	if(document.getElementById('form3'))
	{
		flag = document.getElementById('form3').flag.value;
		if (flag == 0 || flag == 2)
		{
			especialidad = document.getElementById('form3').especialidad.value;
		} else{
			oldEspecialidad = document.getElementById('form3').oldEspecialidad.value;
			newEspecialidad = document.getElementById('form3').newEspecialidad.value;
		}
		
	}

	if (document.getElementById('form4')) {
		cedula = document.getElementById('form4').cc.value;
		nombre = document.getElementById('form4').nombre.value;
		apellido = document.getElementById('form4').apellido.value;
		nacimiento = document.getElementById('form4').nacimiento.value;
		direccion = document.getElementById('form4').direccion.value;
		email = document.getElementById('form4').email.value;
		btn = document.getElementById('form4').btn.value;
	}

	if (document.getElementById('form5')) 
	{
		oldContrasenia = document.getElementById('form5').oldContrasenia.value;
		nContrasenia = document.getElementById('form5').nContrasenia.value;
		cnContrasenia = document.getElementById('form5').cnContrasenia.value;
		btn = document.getElementById('form5').btn.value;
	}

	if (document.getElementById('form6'))
	{
		if (document.getElementById('form6').doctor) {
			doctor = document.getElementById('form6').doctor.value;
		}else
		{
			if (document.getElementById('form6').especial) {
				especialidad = document.getElementById('form6').especial.value;
			}
		}
	}

	ajax.open("POST", fuente, true);
	ajax.onreadystatechange=function() {
		//codigo para mostrar la carga de los datos     
	   	if (ajax.readyState == 1){
	   		obj.innerHTML = "<p></p><BR><p align='center'><img src='img/loading.gif'></p>";
	   		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	     	ajax.send(null);					   
       	}
		
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar los nuevos registros en esta capa
			SetContainerHTML(divID, ajax.responseText, true);
    	}
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    if(document.getElementById('form1'))
		ajax.send("ced="+ced+"&pwd="+pass+"&nocache=" + Math.random());
	else
		if(document.getElementById('form2'))
			if(perfil == "1")
			{
				ajax.send("cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&nacimiento="+nacimiento
						+"&direccion="+direccion+"&email="+email+"&contrasenia="+contrasenia
						+"&perfil="+perfil+"&especialidad="+especialidad+"&horainicio="+horainicio+
						"&horafinal="+horafinal+"&btn="+btn+"&nocache=" + Math.random());
			}else
			{
				ajax.send("cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&nacimiento="+nacimiento
						+"&direccion="+direccion+"&email="+email+"&contrasenia="+contrasenia
						+"&perfil="+perfil+"&btn="+btn+"&nocache=" + Math.random());
			}
		else 
			if(document.getElementById('form3'))
				if (flag == 0 || flag == 2)
					ajax.send("espc="+especialidad+"&flag="+flag+"&nocache=" + Math.random());
				else
					ajax.send("old="+oldEspecialidad+"&new="+newEspecialidad+"&flag="+flag+"&nocache=" + Math.random());
			else
				if (document.getElementById('form4')) 
					{
						ajax.send("cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&nacimiento="+nacimiento
						+"&direccion="+direccion+"&email="+email+"&btn="+btn+"&nocache=" + Math.random());
					} else
					{
						if (document.getElementById('form5'))
						{
							if (nContrasenia == cnContrasenia) 
							{
								ajax.send("oldContrasenia="+oldContrasenia+"&nContrasenia="+nContrasenia+"&nocache="+Math.random());
							}else
							{
								alert('las contraseñas no coinciden!!!');
							}
							
						} else
						{
							if (document.getElementById('form6')) {
								if (document.getElementById('form6').doctor) {
									ajax.send("idCons=medico&val="+doctor+"&nocache="+Math.random());
								}else{

									if (document.getElementById('form6').especial) {
										ajax.send("idCons=especialidad&val="+especialidad+"&nocache="+Math.random());
									}
								}
							}else
							{
								ajax.send(null);
							}
							
						}
					}
				
}

function cargarOpcion (list) {
	
	val = document.getElementById(list).value;

	if(val != "")
	{
		switch(val){

			case "u1": cargarAjax("vista/crearUsuario.php", "escritorio");
			break;
			case "p4": cargarAjax("vista/crearEspecialidad.php", "escritorio");
			break;
			case "p5": cargarAjax("vista/editarEspecialidad.php", "escritorio");
			break;
			case "p6": cargarAjax("vista/eliminarEspecialidad.php", "escritorio");
			break;
			case "r1": cargarAjax("vista/reporteDoctor.php", "escritorio");
			break;
			case "r2": cargarAjax("vista/reporteEspecialidad.php", "escritorio");
			break;
			case "r3": cargarAjax("vista/reporteTodas.php", "escritorio");
			break;
		}
	}
}

function cerrarSesion (fuente, divID) {
	ajax = objetoAjax();

	ajax.open("POST", fuente, true);
	ajax.onreadystatechange=function() {
		//codigo para mostrar la carga de los datos     
	   	if (ajax.readyState == 1){
	   		obj.innerHTML = "<p></p><BR><p align='center'><img src='img/loading.gif'></p>";
	   		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	     	ajax.send(null);					   
       	}
		
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar los nuevos registros en esta capa
			SetContainerHTML(divID, ajax.responseText, true);
    	}
    }
    	
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("sesion="+0+"&nocache=" + Math.random());
}

function gestionCitas (accion) {
	ajax = objetoAjax();

	if(accion != "eliminar" && accion != "estado")
	{
		idPaciente = document.getElementById('form4').cedulaP.value;
		horaInicio = document.getElementById('form4').horainicio.value;
		especialidad = document.getElementById('form4').especialidad.value;
		doctor = document.getElementById('form4').doctor.value;
		fecha = document.getElementById('form4').fecha.value;
	}

	obj = document.getElementById("form4").parentNode;
	ajax.open("POST", "../controlador/Cita_Control.php", true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 1){
	   		obj.innerHTML = "<p></p><BR><p align='center'><img src='img/loading.gif'></p>";
	   		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	     	ajax.send(null);					   
       	}
		
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar los nuevos registros en esta capa
			alert(ajax.responseText);
    	}
	}

	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	if (accion == "editar")
	{
		ajax.send("accion="+accion+"&idCita="+document.getElementById('form4').idCita.value+"&idPaciente="+idPaciente
		+"&horaInicio="+horaInicio+"&especialidad="+especialidad+"&doctor="+doctor+"&fecha="+fecha+"&estado="+document.getElementById('form4').estado.value+"&nocache="+Math.random());
	}else
	{
		if (accion == "eliminar")
		{
			ajax.send("accion="+accion+"&idCita="+document.getElementById('form4').idCita.value+"&nocache="+Math.random());
		}else
		{
			if (accion == "estado")
			{
				ajax.send("accion="+accion+"&idCita="+document.getElementById('form4').idCita.value+"&estado="+document.getElementById('form4').estado.value
					+"&nocache="+"&nocache="+Math.random());
			}else
			{
				ajax.send("accion="+accion+"&idPaciente="+idPaciente+"&horaInicio="+horaInicio+"&especialidad="+especialidad
		    	+"&doctor="+doctor+"&fecha="+fecha+"&estado=pendiente"+"&nocache="+Math.random());
			}
		}
	}
}

function obtenerDoctor (fuente) {
	ajax = objetoAjax();
	obj = document.getElementsByName("divDoctor")[0];

	ajax.open("POST", fuente, true);
	ajax.onreadystatechange=function() {
		//codigo para mostrar la carga de los datos     
	   	if (ajax.readyState == 1){
	   		obj.innerHTML = "<p></p><BR><p align='center'><img src='img/loading.gif'></p>";
	   		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	     	ajax.send(null);					   
       	}
		
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar los nuevos registros en esta capa
			obj.innerHTML=ajax.responseText;
    	}
    }
    	
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("esp="+document.getElementsByName("especialidad")[0].value+"&nocache=" + Math.random());
}

function obtenerEspecialidad () {
	ajax = objetoAjax();
	obj = document.getElementsByName("divEsp")[0];

	perfil = document.getElementById('form2').perfil.value;

	ajax.open("POST", "controlador/Especialidad_Control.php", true);
	ajax.onreadystatechange=function() {
		//codigo para mostrar la carga de los datos     
	   	if (ajax.readyState == 1){
	   		obj.innerHTML = "<p></p><BR><p align='center'><img src='img/loading.gif'></p>";
	   		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	     	ajax.send(null);					   
       	}
		
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar los nuevos registros en esta capa
			obj.innerHTML=ajax.responseText;
    	}
    }
    	
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("esp="+perfil+"&nocache=" + Math.random());
}
