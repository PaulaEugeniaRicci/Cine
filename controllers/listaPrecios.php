<?php

	// ../controllers/listaPrecios.php

	require'../fw/fw.php';
	require'../models/Precios.php';
	require'../views/ListadoPrecios.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$p = new Precios();
	$vError = new ExcepcionAdministracion;

	//Borrar c/ peticion Ajax
	if(!empty($_POST["id_baja"])){
		try {
			$p->borrarPrecios($_POST["id_baja"]);
		}
		catch (ExcepcionPrecio $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'listaPrecios.php';
			$vError-> render();
			exit();
		}
		die();		
	}

	//Retornar precios
	if(!empty($_POST['descripcion_enviar'])){
		$precios_peticion = $p->getPreciosSemana($_POST['descripcion_enviar']);
		echo json_encode($precios_peticion);
		die();		
	}
	
	try{
		$precios = $p->getTodos();
		}
	catch(ExcepcionPrecio $ep){
		$vError->mensaje = $ep->getMessage();
		$vError->enlace = 'listaPrecios.php';
		$vError-> render();
		exit();
	}

	$v = new ListadoPrecios;
	$v->precios = $precios;
	$v->render();
	
	
	