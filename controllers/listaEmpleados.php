<?php

// ../controllers/listaEmpleados.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../models/Sucursales.php';
	require'../views/ListadoEmpleados.php';

	$emp = new Empleados;			// Un modelo
	$v = new ListadoEmpleados;		// Vista, se carga con lo obtenido de modelos
			

	// Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		try{ 
			$todos = $emp->getEmpleadosFiltro($_POST["valor"]); 
			$v->empleados = $todos;
		}		
		catch (ExcepcionEmpleado $e){
			die($e->getMessage());
		}
	}
	
	else if (isset($_POST['setSubmit'])){
		try{ 
			$todos = $emp->getEmpleadosSucursal($_POST["sucursal"]); 
			$v->empleados = $todos;
		}		
		catch (ExcepcionEmpleado $e){
			die($e->getMessage());
		}
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { 
		try{ 
			$todos = $emp->getTodos(); 
			$v->empleados = $todos;
		}
		catch (ExcepcionEmpleado $e){ 
			die($e->getMessage()); 
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


