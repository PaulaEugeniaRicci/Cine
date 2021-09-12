<?php

	// ../controllers/altaPrecios.php

	require'../fw/fw.php';
	require'../models/Precios.php';
	require'../views/AltaPrecios.php';
	require'../views/ExcepcionAdministracion.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/
	
	if (isset($_POST['setSubmit'])){
		$p = new Precios;
		$vError = new ExcepcionAdministracion;

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['descripcion']))die("Debe ingresar la descripcion de la tarifa.");
		if (empty($_POST['dias']))die("Debe ingresar todos los precios para cada dia.");
		$dias = $_POST['dias'];
		if (count($dias) != 7)die("Debe ingresar todos los precios para cada dia.");
		


		try {
			$p->cargarPrecios( 
				$_POST['descripcion'],
				$dias
			);
			header('Location: listaPrecios.php');
		}	 			
		catch (ExcepcionPrecios $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'altaPrecios.php';
			$vError-> render();
			exit();
		}
	}
	
	$v = new AltaPrecios;
	$v->render();
	