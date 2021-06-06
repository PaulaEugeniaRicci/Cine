<?php

	// ../controllers/altaPeliculas.php

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Generos.php';
	require'../models/Clasificaciones.php';
	require'../models/Idiomas.php';
	require'../views/AltaPeliculas.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/
	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['titulo']))die("Debe ingresar el titulo de la pelicula.");
		if (empty($_POST['genero']))die ("Debe ingresar al menos un genero.");
		if (empty($_POST['director']))die("Debe ingresar el director de la pelicula.");
		$duracion = $_POST['duracion'];
		if ($duracion < 20)die("La duración de la pelicula no puede ser menor a 20 minutos.");
		if (empty($_POST['sinopsis']))die("Debe ingresar la sinopsis de la pelicula.");
		if(empty($_FILES['poster']))die("Debe ingresar el poster de la pelicula");
		if(empty($_POST['trailer']))die("Debe ingresar el trailer de la pelicula");		
		
		$poster= addslashes(file_get_contents($_FILES['poster']['tmp_name'])); 
		
		

		$peli = new Peliculas;
	
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
			//header('Location: lista-peliculas'); CAMBIAR CUANDO SE HAGA EL HTACCESS
			header('Location: listaPeliculas.php');
		}
		catch (ExcepcionPelicula $ep){ 
			die($ep->getMessage());
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
