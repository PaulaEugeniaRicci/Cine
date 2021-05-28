<?php

// ../controllers/bajaPeliculas.php

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../views/ListadoPeliculas.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}*/

	$pelis = new Peliculas;			//Modelo
	
	if (!empty($_POST["ID"])){
		try {
			$pelis->borrarPeliculas($_POST["ID"]);
		}
		catch (ExcepcionPelicula $ep){ 
			die($ep->getMessage()); 
		}
		header('Location: listaPeliculas.php');
	}
	
	try {
		$todos = $pelis->getTodos();
	}
 	catch (ExcepcionPelicula $ep){ 
 		die($ep->getMessage()); 
 	}
 	
 	$v = new ListadoPeliculas;	//Vista
 	$v->peliculas = $todos;
	$v->render();