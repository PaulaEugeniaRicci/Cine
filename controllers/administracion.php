<?php

	// ../controllers/administracion.php
	require'../fw/fw.php';
	require'../models/Usuarios.php';
	require'../views/Administracion.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$user = new Usuarios;			
	$v = new Administracion;		
	$vError = new ExcepcionAdministracion;

	//Borrar
	if (!empty($_POST["id_baja"])){
		try {
			$user->borrarUsuarios($_POST["id_baja"]);
		}
		catch (ExcepcionAdministracion $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'administracion.php';
			$vError-> render();
			exit();
		}		
	}

	
		try{ 
			$todos = $user->getTodos(); 
			$v->usuarios = $todos;
		}
		catch (ExcepcionAdministracion $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'administracion.php';
			$vError-> render();
			exit();
		}

	

	$v-> render();
