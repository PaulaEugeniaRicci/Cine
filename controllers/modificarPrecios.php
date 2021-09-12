<?php

	// ../controllers/modificarPrecios.php

	require'../fw/fw.php';
	require'../models/Precios.php';
	require'../views/ModificarPrecios.php';
	require'../views/ExcepcionAdministracion.php';
	
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/


	$p = new Precios;
	$vError = new ExcepcionAdministracion;

	//Retornar precios
	if(!empty($_POST['descripcion_enviar'])){
		$precios_peticion = $p->getPreciosSemana($_POST['descripcion_enviar']);
		echo json_encode($precios_peticion);
		die();		
	}

	if (isset($_POST['setSubmit']) && !empty($_GET['idp'])){
		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['descripcion']))die("Debe ingresar la descripcion de la tarifa.");
		if (empty($_POST['dias']))die("Debe ingresar todos los precios para cada dia.");
		$dias = $_POST['dias'];
		if (count($dias) != 7)die("Debe ingresar todos los precios para cada dia.");

		
	
		try {
			$p->modificarPrecios(
				$_GET['idp'],
				$_POST['descripcion'],
				$dias
			);
			header('Location: listaPrecios.php');
		}	 			
		catch (ExcepcionPrecio $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPrecios.php';
			$vError-> render();
			exit();
		}
	}
	try{
		$precios = $p->getPrecioById($_GET['idp']);
		}
		catch(ExcepcionPrecio $ep){
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPrecios.php';
			$vError-> render();
			exit();
	}
	
	$v = new ModificarPrecios;
	$v->precios = $precios;
	$v->render();
	