<?php

// ../controllers/bajaEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../views/ListadoEmpleados.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}*/

	$emp = new Empleados;			//Modelo
	
	if (!empty($_POST["ID"])){
		try {
			$emp->borrarEmpleados($_POST["ID"]);
		}
		catch (ExcepcionEmpleado $e){ 
			die($e->getMessage()); 
		}
		header('Location: listaEmpleados.php');
	}
	
	try {
		$todos = $emp->getTodos();
	}
 	catch (ExcepcionEmpleado $e){ 
 		die($e->getMessage()); 
 	}
 	
 	$v = new ListadoEmpleados;	//Vista
 	$v->empleados = $todos;
	$v->render();