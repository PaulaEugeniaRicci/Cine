<?php

// ../controllers/recaudacion.php

	require'../fw/fw.php';
	require'../models/Pagos.php';
	require'../models/Sucursales.php';
	require'../views/Recaudacion.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$pagos = new Pagos;	
	$suc = new Sucursales;		
	$v = new Recaudacion;		
	$vError = new ExcepcionAdministracion;


	// Si el usuario eligió filtrado
	if (!empty($_POST['sucursal'])){
		try{ 
			$resumenSucursal = $pagos->getResumenSucursal($_POST["sucursal"]); 
			$v->resumen = $resumenSucursal;
		}		
		catch (ExcepcionPago $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'recaudacion.php';
			$vError-> render();
			exit();
		}

		try{ 
			$sucursal = $suc->getById($_POST["sucursal"]); 
			$v->sucursalDetalle = strtoupper($sucursal[0]["descripcion"]);
		}		
		catch (ExcepcionSucursal $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'recaudacion.php';
			$vError-> render();
			exit();
		}
	}
	// Si el usuario recién ingresa o no eligió nada, se muestra por default una sucursal
	else { 
		try{ 
			$resumenSucursal = $pagos->getResumenSucursal(3); 
			$v->resumen = $resumenSucursal;
		}		
		catch (ExcepcionPago $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaProyecciones.php';
			$vError-> render();
			exit();
		}

		try{ 
			$sucursal = $suc->getById(3); 
			$v->sucursalDetalle = strtoupper($sucursal[0]["descripcion"]);
		}		
		catch (ExcepcionSucursal $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'recaudacion.php';
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

	$v->sucursales = $sucursales;
	$v-> render();