<?php

	// ../controllers/altaEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../models/Sucursales.php';
	require'../views/AltaEmpleados.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/
	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del empleado.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del empleado.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['direccion']))die("Debe ingresar direccion del empleado");
		if (empty($_POST['cuit'])) die("Debe ingresar un CUIT valido");
		if (empty($_POST['usuario'])) die("Debe ingresar un nombre de usuario");
		if (empty($_POST['contrasenia'])) die("Debe ingresar una contrasenia para el usuario");

		
		$emp = new Empleados;

		try {
			$emp->cargarEmpleados(
				$_POST['nombre'],
				$_POST['apellido'],
				$_POST['telefono'],
				$_POST['direccion'],
				$_POST['cuit'],
				$_POST['sucursal'],
				$_POST['usuario'],
				$_POST['contrasenia']
			);
			//header('Location: lista-empleados'); CAMBIAR CUANDO SE HAGA EL HTACCESS
			header('Location: altaEmpleados.php');
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

	$v = new AltaEmpleados;
	$v->sucursales = $sucursales;
	$v->render();
