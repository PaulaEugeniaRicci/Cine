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

	$pelis = new Peliculas;			// Un modelo
	$v = new Pelicula;		// Vista, se carga con lo obtenido de modelos


	try{ 
			$todos = $pelis->getTodos(); 
			$v->pelicula = $todos;
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}

	$v-> render();


