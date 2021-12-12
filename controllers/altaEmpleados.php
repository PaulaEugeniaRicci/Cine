<?php

	// ../controllers/altaEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../models/Sucursales.php';
	require'../views/AltaEmpleados.php';
	require'../views/ExcepcionAdministracion.php';
	
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	if (isset($_POST['setSubmit'])){

		$emp = new Empleados;
		$vError = new ExcepcionAdministracion;

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del empleado.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del empleado.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['direccion']))die("Debe ingresar direccion del empleado");
		if (empty($_POST['cuil'])) die("Debe ingresar un CUIL valido");
		
		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['sucursal'])){
			$vError->mensaje = "Debe ingresar la sucursal.";
			$vError->enlace = 'altaEmpleados.php';
			$vError-> render();
			exit();
		}
		

		try {
			$emp->cargarEmpleados(
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
			$vError->enlace = 'altaEmpleados.php';
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

	$v = new AltaEmpleados;
	$v->sucursales = $sucursales;
	$v->render();
