<?php

	// ../controllers/altaPeliculas.php

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Generos.php';
	require'../models/Clasificaciones.php';
	require'../models/Idiomas.php';
	require'../views/AltaPeliculas.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	if (isset($_POST['setSubmit'])){

		$peli = new Peliculas;
		$vError = new ExcepcionAdministracion;

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['titulo']))die("Debe ingresar el titulo de la pelicula.");
		if (empty($_POST['genero']))die ("Debe ingresar al menos un genero.");
		if (empty($_POST['director']))die("Debe ingresar el director de la pelicula.");
		$duracion = $_POST['duracion'];
		if ($duracion < 20)die("La duración de la pelicula no puede ser menor a 20 minutos.");
		if (empty($_POST['sinopsis']))die("Debe ingresar la sinopsis de la pelicula.");
		if(empty($_FILES['poster']))die("Debe ingresar el poster de la pelicula");
		if(empty($_POST['trailer']))die("Debe ingresar el trailer de la pelicula");		
		
		$poster= addslashes(file_get_contents($_FILES['poster']['tmp_name'])); 
		
		//VALIDACIONES DEL INPUT - Fecha de Estreno no puede ser mayor a un mes contando desde la fecha actual, ni menor al 19 de marzo de 1895, la primera pelicula de la historia, para ser bien exactos(?)
		if (empty($_POST['fecha'])){
			$vError->mensaje = "Debe ingresar la fecha de estreno.";
			$vError->enlace = 'altaPeliculas.php';
			$vError-> render();
			exit();
		}
		else{
			date_default_timezone_set('America/Argentina/Buenos_Aires'); 	
			$fecha_estreno =  new DateTime ($_POST['fecha']);
			
			$fecha_a = '1895-03-19';
			$fecha_antigua =  new DateTime($fecha_a);

			$fecha_futuro = new DateTime();
			$fecha_futuro-> modify('+1 month');

			if ($fecha_estreno < $fecha_antigua){
				$vError->mensaje = "La fecha de estreno no es valida.";
				$vError->enlace = 'altaPeliculas.php';
				$vError-> render();
				exit();
			}
			if ($fecha_estreno > $fecha_futuro) {
				$vError->mensaje = "La fecha de estreno no es valida.";
				$vError->enlace = 'altaPeliculas.php';
				$vError-> render();
				exit();
			}
		}

		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['clasificacion'])){
			$vError->mensaje = "Debe seleccionar la clasificación.";
			$vError->enlace = 'altaPeliculas.php';
			$vError-> render();
			exit();
		}
		if (empty($_POST['idioma'])){
			$vError->mensaje = "Debe seleccionar el idioma original.";
			$vError->enlace = 'altaPeliculas.php';
			$vError-> render();
			exit();
		}
		if (empty($_POST['subtitulado'])){
			$vError->mensaje = "Debe seleccionar si la pelicula se encuentra subtitulada o doblada.";
			$vError->enlace = 'altaPeliculas.php';
			$vError-> render();
			exit();
		}

		try {
			$peli->cargarPeliculas( 
				$_POST['titulo'],
				$_POST['genero'],
				$_POST['director'],
				$_POST['clasificacion'],
				$_POST['duracion'],
				$_POST['idioma'],
				$_POST['subtitulado'],
				$_POST['sinopsis'],
				$_POST['fecha'],
				$poster,
				$_POST['trailer']
			);
			header('Location: listaPeliculas.php');
		}
		catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'altaPeliculas.php';
			$vError-> render();
			exit(); 
		}
	}

	$g = new Generos;
	try{
		$generos = $g->getTodos();
	}
	catch(ExcepcionGenero $eg){
		die($eg->getMessage());
	}

	$c = new Clasificaciones;
	try{
		$clasificaciones = $c->getTodos();
	}
	catch(ExcepcionGenero $ec){
		die($ec->getMessage());
	}

	$i = new Idiomas;
	try{
		$idiomas = $i->getTodos();
	}
	catch(ExcepcionIdioma $ei){
		die($ei->getMessage());
	}

	$v = new AltaPeliculas;
	$v->generos = $generos;
	$v->clasificaciones = $clasificaciones;
	$v->idiomas = $idiomas;
	$v->render();
