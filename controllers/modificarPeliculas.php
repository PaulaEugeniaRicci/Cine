<?php

	// ../controllers/modificarPeliculas.php

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Generos.php';
	require'../models/Clasificaciones.php';
	require'../models/Idiomas.php';
	require'../views/ModificarPeliculas.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$peli = new Peliculas;
	$g = new Generos;
	$vError = new ExcepcionAdministracion;
	
	//RETORNAR ARRAY DE GENEROS
	if(!empty($_POST['id_enviar'])){
		$generos_peticion = $peli->getGenerosPelis($_POST['id_enviar']);
		echo json_encode($generos_peticion);
	}

	if (isset($_POST['setSubmit']) && !empty($_GET['idp'])){

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['titulo']))die("Debe ingresar el titulo de la pelicula.");
		if (empty($_POST['genero']))die ("Debe ingresar al menos un genero.");
		if (empty($_POST['director']))die("Debe ingresar el director de la pelicula.");
		$duracion = $_POST['duracion'];
		if ($duracion < 20)die("La duración de la pelicula no puede ser menor a 20 minutos.");
		if (empty($_POST['sinopsis']))die("Debe ingresar la sinopsis de la pelicula.");
		if (empty($_POST['trailer']))die("Debe ingresar el trailer de la pelicula.");
		if(!empty($_FILES['poster'])){
			$poster= addslashes(file_get_contents($_FILES['poster']['tmp_name'])); 
		}
		
		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['clasificacion'])){
			$vError->mensaje = "Debe seleccionar la clasificación.";
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}
		if (empty($_POST['idioma'])){
			$vError->mensaje = "Debe seleccionar el idioma original.";
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}
		if (empty($_POST['subtitulado'])){
			$vError->mensaje = "Debe seleccionar si la pelicula se encuentra subtitulada o doblada.";
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}

		try {
			$peli->modificarPeliculas(
				$_GET['idp'],
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
			die($ep->getMessage());
		}
	}

	if (!empty($_GET['idp'])){
	try{
		$pelicula = $peli->getPelicula($_GET['idp']);
		}
		catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit(); 
		}
	
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

	$v = new ModificarPeliculas;
	$v->peliculas = $pelicula;
	$v->generos = $generos;
	$v->clasificaciones = $clasificaciones;
	$v->idiomas = $idiomas;
	$v->render();
	}
?>