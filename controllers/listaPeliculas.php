<?php

// ../controllers/listaPeliculas.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Clasificaciones.php';
	require'../views/ListadoPeliculas.php';

	$pelis = new Peliculas;			// Un modelo
	$v = new ListadoPeliculas;		// Vista, se carga con lo obtenido de modelos
			

	//Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		try{ 
			$todos = $pelis->getPelisTitulo($_POST["valor"]); 
			$v->peliculas = $todos;
		}		
		catch (ExcepcionPelicula $ep){
			die($ep->getMessage());
		}
	}
	else if (isset($_POST['setSubmit'])){
		try{ 
			$todos = $pelis->getPelisClasificacion($_POST["clasificacion"]); 
			$v->peliculas = $todos;
		}		
		catch (ExcepcionPelicula $ep){
			die($ep->getMessage());
		}
	}

	// Si el usuario recién ingresa o no eligió nada, se muestran todas las pelis
	else { 
		try{ 
				$todos = $pelis->getTodos(); 
				$v->peliculas = $todos;
			}
			catch (ExcepcionPelicula $ep){ 
				die($ep->getMessage()); 
			}
	}

	$c = new Clasificaciones;
	try{
		$clasificaciones = $c->getTodos();
	}
	catch(ExcepcionClasificacion $ec){
		die($ec->getMessage());
	}

	$v->clasificaciones = $clasificaciones;
	$v-> render();


