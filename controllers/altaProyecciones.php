<?php

	// ../controllers/altaProyecciones.php

	require'../fw/fw.php';
	require'../models/Proyecciones.php';
	require'../models/Peliculas.php';
	require'../models/Salas.php';
	require'../views/AltaProyecciones.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	if (isset($_POST['setSubmit'])){

		$pp = new Proyecciones;
		$vError = new ExcepcionAdministracion;

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['horario']))die("Debe ingresar el horario.");
		if (empty($_POST['dias']))die ("Debe ingresar al menos un dia.");
		$dias = $_POST['dias'];
		
		//VALIDACIONES DEL INPUT - Constatar horario de proyeccion
		$date_horario = new DateTime($_POST['horario']);
		$date_minimo = new DateTime("09:00");
		$date_maximo = new DateTIme("03:00");
		if ($date_horario > $date_maximo && $date_horario < $date_minimo)die("El horario elegido no es válido. Las proyecciones son entre las 09:00hs hasta las 03:00hs.");

		//VALIDACIONES DEL INPUT - Fecha de primera proyeccion no puede ser inferior a hoy.
		if (empty($_POST['fecha1'])){
			$vError->mensaje = "Debe ingresar la primera fecha de la proyección.";
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		}
		else{
			date_default_timezone_set('America/Argentina/Buenos_Aires'); 	
			$primera_fecha =  new DateTime ($_POST['fecha1']);
			
			$hoy = new DateTime();
			date_time_set($hoy, 0, 0, 0);

			if ($primera_fecha < $hoy){
				$vError->mensaje = "La primera fecha de proyeccion no puede ser menor a hoy.";
				$vError->enlace = 'altaProyecciones.php';
				$vError-> render();
				exit();
			}
		}
		//VALIDACIONES DEL INPUT - Fecha de ultima proyeccion no puede ser mayor a 2 meses desde hoy.
		if (empty($_POST['fecha2'])){
			$vError->mensaje = "Debe ingresar la ultima fecha de la proyección.";
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		}
		else{
			date_default_timezone_set('America/Argentina/Buenos_Aires'); 	
			$ultima_fecha =  new DateTime ($_POST['fecha2']);
			$fecha_futuro = new DateTime();
			$fecha_futuro-> modify('+2 month');

			if ($ultima_fecha > $fecha_futuro) {
				$vError->mensaje = "La ultima fecha de proyeccion no puede ser mayor a los proximos dos meses.";
				$vError->enlace = 'altaProyecciones.php';
				$vError-> render();
				exit();
			}
		}
		
		if($_POST['fecha2'] < $_POST['fecha1']){
			$vError->mensaje = "Las fechas no son válidas.";
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		} 

		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['pelicula'])){
			$vError->mensaje = "Debe seleccionar la pelicula.";
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		}
		if (empty($_POST['sala'])){
			$vError->mensaje = "Debe seleccionar la sala.";
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		}

		try {
			$pp->cargarProyecciones( 
				$_POST['pelicula'],
				$_POST['sala'],
				$_POST['horario'],
				$_POST['fecha1'],
				$_POST['fecha2'],
				$dias
			);
			//header('Location: listaProyecciones.php');
		}	 			
		catch (ExcepcionProyeccion $epp){ 
			$vError->mensaje = $epp->getMessage();
			$vError->enlace = 'altaProyecciones.php';
			$vError-> render();
			exit();
		}

	}


	$p = new Peliculas;
	$s= new Salas;

	try{
		
		$pelis= $p->getTodos();
	}
	catch(ExcepcionPelicula $ep){
		$vError->mensaje = $ep->getMessage();
		$vError->enlace = 'listaProyecciones.php';
		$vError-> render();
		exit();
	}

	try{
		
		$salas = $s->getTodos();
	}
	catch(ExcepcionSalas $es){
		die($es->getMessage());
	}		
	
	$v = new altaProyecciones;
	$v->peliculas = $pelis;
	$v->salas = $salas;	
	$v->render();
