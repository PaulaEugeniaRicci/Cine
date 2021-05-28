<?php

// ../controllers/pagos.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../views/Pagos.php';
		require'../models/Sucursales.php';

	$pelis = new Peliculas;			// Un modelo
	$v = new Pagos;		// Vista, se carga con lo obtenido de modelos
$suc = new Sucursales;

	try{ 
			$todos = $pelis->getTodos(); 
			$v->pelicula = $todos;
			$todosSuc= $suc->getTodos();
			$v->sucursales = $todosSuc;
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}

	$v-> render();


