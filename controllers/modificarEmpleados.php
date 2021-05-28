<?php

	// ../controllers/modificarEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../models/Sucursales.php';
	require'../views/ModificarEmpleados.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}*/

	if (isset($_POST['setSubmit']) && !empty($_POST['ID'])){

		$emp = new Empleados();
		try {
			$emp->modificarEmpleados(
				$_POST['ID'],
				$_POST['nombre'],
				$_POST['apellido'],
				$_POST['telefono'],
				$_POST['direccion'],
				$_POST['cuit'],
				$_POST['sucursal'],
				$_POST['usuario'],
				$_POST['contrasenia']
			);
			header('Location: listaEmpleados.php');
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

	$v = new ModificarEmpleados;
	$v->sucursales = $sucursales;
	$v->render();