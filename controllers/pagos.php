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
	require'../views/PagoOk.php';
	require'../views/PagoFail.php';
	require'../models/Sucursales.php';

	$pelis = new Peliculas;			// Un modelo
		// Vista, se carga con lo obtenido de modelos
	$suc = new Sucursales;

if(isset($_POST['id_pelicula'])){
		$v = new Pagos;	
	try{ 
			$peli = $pelis->getPelicula($_POST['id_pelicula']); 
			$v->pelicula = $peli;
			$todosSuc= $suc->getTodos();
			$v->sucursales = $todosSuc;
		}
		catch (ExcepcionPelicula $e){ 
			die($e->getMessage()); 
		}
}

if(isset($_POST['nro_tarjeta'])){
	$peli = $pelis->getPelicula($_POST['id_pelicula']); 
			

	$nro_tarjeta = $_POST['nro_tarjeta'];
	$digito = substr($nro_tarjeta, 0, 1);
	$seguridad = strlen($_POST['seguridad']);
	$metodo = $_POST['metodo'];

	if(strlen($nro_tarjeta)==16){
		$v = new PagoFail; $v->pelicula = $peli;

		if($metodo == 1 && $digito == 4 && $seguridad == 3){
			$v = new PagoOk;
			$v->pelicula = $peli;
		}

		if($metodo == 2 && $digito == 5 && $seguridad == 3){
			$v = new PagoOk;
			$v->pelicula = $peli;
		}

	}
	
	
}


	$v-> render();



