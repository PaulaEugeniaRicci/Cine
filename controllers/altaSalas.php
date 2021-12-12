<?php

	// ../controllers/altaSalas.php

	require'../fw/fw.php';
	require'../models/Salas.php';
	require'../models/Sucursales.php';
	require'../views/AltaSalas.php';
	require'../views/ExcepcionAdministracion.php';
	
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	if (isset($_POST['setSubmit'])){

		$sala = new Salas;				
		$vError = new ExcepcionAdministracion;


		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['nombre']))die("Debe ingresar el nombre de la sala");
		if (empty($_POST['cant_asientos']))die("Debe ingresar la cantidad de butacas.");
	
		if (empty($_POST['sucursal'])){
			$vError->mensaje = "Debe ingresar la sucursal.";
			$vError->enlace = 'altaSalas.php';
			$vError-> render();
			exit();
		}
		
		try {
			$sala->cargarSalas(
				$_POST['nombre'],
				$_POST['cant_asientos'],
				$_POST['sucursal']
			);
			header('Location: listaSalas.php');
		}
		catch (ExcepcionSala $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'altaSalas.php';
			$vError-> render();
			exit();
		}
	}

	$s = new Sucursales;
	try{
		$sucursales = $s->getTodos();
	}
	catch(ExcepcionSucursal $es){
		die($es->getMessage());
	}

	$v = new AltaSalas;
	$v->sucursales = $sucursales;
	$v->render();
