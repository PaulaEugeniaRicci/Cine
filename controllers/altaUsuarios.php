<?php

	// ../controllers/altaUsuarioss.php

	require'../fw/fw.php';
	require'../models/Usuarios.php';
	require'../models/Empleados.php';
	require'../views/AltaUsuarios.php';
	require'../views/ExcepcionAdministracion.php';
	
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	$user = new Usuarios;
	$emp = new Empleados;
	$vError = new ExcepcionAdministracion;

	try{
		
		$usuarios= $emp->getTodos();
	}
	catch(ExcepcionEmpleado $e){
		$vError->mensaje = $e->getMessage();
		$vError->enlace = 'administracion.php';
		$vError-> render();
		exit();
	}

	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['email']))die("Debe ingresar un email.");
		if (empty($_POST['password']))die("Debe ingresar su password.");
		if (empty($_POST['rol'])) die("Debe seleccionar un rol.");

		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['usuario'])){
			$vError->mensaje = "Debe ingresar el empleado.";
			$vError->enlace = 'altaUsuarios.php';
			$vError-> render();
			exit();
		}
	
		try {
			$user->cargarUsuarios(
				$_POST['email'],
				$_POST['password'],
				$_POST['rol'],
				$_POST['usuario']
			);
			header('Location: administracion.php');
		}
		catch (ExcepcionUsuario $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'altaUsuarios.php';
			$vError-> render();
			exit();
		}
	}

	$v = new AltaUsuarios;
	$v->usuarios = $usuarios;
	$v->render();