<?php

// ../controllers/index.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Sucursales.php';
	require'../views/Index.php';

	$pelis = new Peliculas;			// Un modelo
	$suc = new Sucursales;
	$v = new Index;		// Vista, se carga con lo obtenido de modelos
			

	try{ 
			$todos = $pelis->getTodos(); 
			$todosSuc= $suc->getTodos();
			$v->peliculas = $todos;
			$v->sucursales = $todosSuc;
			
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}

	$v-> render();


