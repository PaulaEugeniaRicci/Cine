<?php

// ../controllers/pelicula.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../views/Pelicula.php';

	if(isset($_POST['id_pelicula'])){
		


		$pelis = new Peliculas;			// Un modelo

		try{ 
			$datos_peli = $pelis->getPelicula($_POST['id_pelicula']);
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}
	}

	
	$v = new Pelicula;		// Vista, se carga con lo obtenido de modelos
	$v->pelicula = $datos_peli ;

	$v-> render();


