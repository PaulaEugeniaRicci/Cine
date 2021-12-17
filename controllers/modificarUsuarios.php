<?php

	// ../controllers/modificarUsuarios.php

	require'../fw/fw.php';
	require'../models/Usuarios.php';
	require'../views/ModificarUsuarios.php';
	require'../views/ExcepcionAdministracion.php';
	
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$user = new Usuarios;
	$vError = new ExcepcionAdministracion;
	
	if (isset($_POST['setSubmit']) && !empty($_GET['ide'])){

		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['email']))die("Debe ingresar un email.");
		//if (empty($_POST['password']))die("Debe ingresar su password.");
		if (empty($_POST['rol'])) die("Debe seleccionar un rol.");

		//VALIDACIONES DEL INPUT - Select
		if (empty($_POST['usuario'])){
			$vError->mensaje = "Debe ingresar el empleado.";
			$vError->enlace = 'modificarUsuarios.php';
			$vError-> render();
			exit();
		}

		try {
			$user->modificarUsuarios(
				$_POST['email'],
				$_POST['password'],
				$_POST['rol'],
				$_POST['usuario']
			);
			header('Location: administracion.php');
		}
		catch (ExcepcionUsuario $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'modificarUsuarios.php';
			$vError-> render();
			exit();
		}
	}


	try{
		$usuarios = $user->getUsuarioById($_GET['ide']);
	}
	catch (ExcepcionUsuario $e){ 
		$vError->mensaje = $e->getMessage();
		$vError->enlace = 'administracion.php';
		$vError-> render();
		exit();
	}

	$v = new ModificarUsuarios;
	$v->usuarios = $usuarios;
	$v->render();