<?php

	// ../controllers/modificarEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../models/Sucursales.php';
	require'../views/ModificarEmpleados.php';
	require'../views/ExcepcionAdministracion.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}*/

	$emp = new Empleados();
	$vError = new ExcepcionAdministracion;
	
	if (isset($_POST['setSubmit']) && !empty($_GET['ide'])){

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del empleado.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del empleado.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['direccion']))die("Debe ingresar direccion del empleado");
		if (empty($_POST['cuil'])) die("Debe ingresar un CUIL valido");
		
		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['sucursal'])){
			$vError->mensaje = "Debe seleccionar la sucursal.";
			$vError->enlace = 'modificarEmpleados.php';
			$vError-> render();
			exit();
		}

		try {
			$emp->modificarEmpleados(
				$_GET['ide'],
				$_POST['nombre'],
				$_POST['apellido'],
				$_POST['telefono'],
				$_POST['direccion'],
				$_POST['cuil'],
				$_POST['sucursal']
			);
			header('Location: listaEmpleados.php');
		}
		catch (ExcepcionEmpleado $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'modificarEmpleados.php';
			$vError-> render();
			exit();
		}
	}
	try{
		$empleado = $emp->getEmpleadoById($_GET['ide']);
		}
		catch (ExcepcionEmpleado $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaEmpleados.php';
			$vError-> render();
			exit();
		}

	$s = new Sucursales;
	try{
		$sucursales = $s->getTodos();
	}
	catch(ExcepcionSucursal $es){
		die($es->getMessage());
	}

	$v = new ModificarEmpleados;
	$v->empleados = $empleado;
	$v->sucursales = $sucursales;
	$v->render();