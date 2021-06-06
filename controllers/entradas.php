<?php

// ../controllers/entradas.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../views/Entradas.php';
	require'../models/Sucursales.php';

if(isset($_POST['id_pelicula'])){
	$pelis = new Peliculas;			// Un modelo
	$suc = new Sucursales;

	try{ 
			$peli = $pelis->getPelicula($_POST['id_pelicula']); 
			$todosSuc= $suc->getTodos();

			
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}


}
$v = new Entradas;		// Vista, se carga con lo obtenido de modelos
$v->pelicula = $peli;			
$v->sucursales = $todosSuc;
$v->render();
	


