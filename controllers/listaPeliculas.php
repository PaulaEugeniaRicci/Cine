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
	require'../views/ExcepcionAdministracion.php';

	$pelis = new Peliculas;			// Un modelo
	$v = new ListadoPeliculas;		// Vista, se carga con lo obtenido de modelos
	$vError = new ExcepcionAdministracion;
	
	//Borrar
	if (!empty($_POST["id_baja"])){
		try {
			$pelis->borrarPeliculas($_POST["id_baja"]);
		}
		catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}	
	}		

	//Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		try{ 
			$todos = $pelis->getPelisTitulo($_POST["valor"]); 
			$v->peliculas = $todos;
		}		
		catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}	
	}
	else if (isset($_POST['setSubmit']) && !empty($_POST["clasificacion"])){
		try{ 
			$todos = $pelis->getPelisClasificacion($_POST["clasificacion"]); 
			$v->peliculas = $todos;
		}		
		catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
		}	
	}

	// Si el usuario recién ingresa o no eligió nada, se muestran todas las pelis
	else { 
		try{ 
				$todos = $pelis->getTodos(); 
				$v->peliculas = $todos;
			}
			catch (ExcepcionPelicula $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPeliculas.php';
			$vError-> render();
			exit();
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


