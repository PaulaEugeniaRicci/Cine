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
	require'../models/Proyecciones.php';
	require'../models/Sucursales.php';
	require'../views/Index.php';
	require'../views/ExcepcionIndex.php';

	$proy = new Proyecciones;			
	$suc = new Sucursales;		
	$v = new Index;
	$vError = new ExcepcionIndex;		
	  

	$sucursales= $suc->getTodos();
	  
	//Si el usuario eligió filtrado
	if(!empty($_POST['sucursal']) && $_POST['sucursal'] != 0){

		$v->id_sucursal = $_POST['sucursal'];
		$id = $_POST['sucursal'];

		try{
			$proyecciones = $proy->getPelisProyeccionesSucursal($id);
			$v->proyecciones = $proyecciones;
		}
		catch (ExcepcionProyeccion $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'index.php';
			$vError->sucursales = $sucursales;
			$vError->id_sucursal = $_POST['sucursal'];
			$vError-> render();
			exit();
		}				
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todas las peliculas
	elseif(empty($_POST['sucursal']) || $_POST['sucursal'] == 0) {
		$v->id_sucursal = 0;
	
		try{
			$proyecciones = $proy->getPelisProyecciones();
			$v->proyecciones = $proyecciones;
		}
		catch (ExcepcionProyeccion $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'index.php';
			$vError->sucursales = $sucursales;
			$vError->id_sucursal = $_POST['sucursal'];
			$vError-> render();
			exit();
		}		
	}
		
	$v->sucursales = $sucursales;
	$v-> render();


