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
	require'../models/Proyecciones.php';
	require'../views/ExcepcionCliente.php';

	$vError = new ExcepcionCliente;
	$v = new Entradas;

	$pelis = new Peliculas;			
	$proyec = new Proyecciones;
		
	
	if(isset($_GET['id_pelicula'])){

		$id_sucursal = ($_GET['id_sucursal']);			
		$v->id_sucursal = $id_sucursal;

		try{ 
			$pelicula = $pelis->getPelicula($_GET['id_pelicula']); 
			$v->pelicula = $pelicula;		
		}
		catch (ExcepcionPelicula $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit();
		}
		try{
			$sucursales= $proyec->getSucursalbyPelicula($_GET['id_pelicula']);
			$v->sucursales = $sucursales;
			$v->pelicula = $pelicula;	
		}
		catch(ExcepcionProyeccion $epp){ 
			$vError->mensaje = $epp->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit();
		}
	}

	//Peticiones Ajax

	if(!empty($_POST['peli']) && !empty($_POST['suc'])){
		
		$fechas_peticion = $proyec->getFechasSinHora($_POST['suc'], $_POST['peli']);
		echo json_encode($fechas_peticion);
		die(); //despues de 893482874 horas descubro que es necesario usar die
		//para evitar retornar la renderizacion del html en la peticion? 
	}

	if (!empty($_POST['fecha'])){

		$horarios_peticion = $proyec->getHorasSinFecha($_POST['sucFecha'], $_POST['peliFecha'], $_POST['fecha']);
		echo json_encode($horarios_peticion);
		die();
	}

	if (!empty($_POST['id_proyeccion'])){
		$tarifas_peticion = $proyec->getTarifaSala($_POST['id_proyeccion']);
		echo json_encode($tarifas_peticion);
		die();
		
	}

	
	
	$v->render();
	


