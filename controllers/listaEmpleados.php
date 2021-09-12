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
	require'../views/ExcepcionAdministracion.php';

	$emp = new Empleados;			// Un modelo
	$v = new ListadoEmpleados;		// Vista, se carga con lo obtenido de modelos
	$vError = new ExcepcionAdministracion;

	//Borrar
	if (!empty($_POST["id_baja"])){
		try {
			$emp->borrarEmpleados($_POST["id_baja"]);
		}
		catch (ExcepcionEmpleado $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaEmpleados.php';
			$vError-> render();
			exit();
		}		
	}

	// Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		try{ 
			$todos = $emp->getEmpleadosFiltro($_POST["valor"]); 
			$v->empleados = $todos;
		}		
		catch (ExcepcionEmpleado $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaEmpleados.php';
			$vError-> render();
			exit();
		}
	}
	
	else if (!empty($_POST['sucursal'])){
		try{ 
			$todos = $emp->getEmpleadosSucursal($_POST["sucursal"]); 
			$v->empleados = $todos;
		}		
		catch (ExcepcionEmpleado $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaEmpleados.php';
			$vError-> render();
			exit();
		}
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { 
		try{ 
			$todos = $emp->getTodos(); 
			$v->empleados = $todos;
		}
		catch (ExcepcionEmpleado $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaEmpleados.php';
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


