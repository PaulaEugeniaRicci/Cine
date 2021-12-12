<?php

// ../controllers/listaSalas.php

	require'../fw/fw.php';
	require'../models/Salas.php';
	require'../models/Sucursales.php';
	require'../views/ListadoSalas.php';
	require'../views/ExcepcionAdministracion.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$sala = new Salas;			
	$v = new ListadoSalas;		
	$vError = new ExcepcionAdministracion;

	//Borrar
	if (!empty($_POST["id_baja"])){
		try {
			$sala->borrarSalas($_POST["id_baja"]);
		}
		catch (ExcepcionSala $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaSalas.php';
			$vError-> render();
			exit();
		}		
	}

	//Si el usuario eligió filtrado
	if (!empty($_POST['sucursal'])){
		try{ 
			$todos = $sala->getSalasSucursal($_POST["sucursal"]); 
			$v->salas = $todos;
		}		
		catch (ExcepcionSala $e){
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaSalas.php';
			$vError-> render();
			exit();
		}
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { 
		try{ 
			$todos = $sala->getTodos(); 
			$v->salas = $todos;
		}
		catch (ExcepcionSala $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'listaSalas.php';
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


