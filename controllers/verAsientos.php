<?php

// ../controllers/verAsientos.php

	require'../fw/fw.php';
	require'../models/Salas.php';
	require'../models/Sucursales.php';
	require'../views/VerAsientos.php';
	require'../views/ExcepcionAdministracion.php';

	$sala = new Salas;			
	$v = new VerAsientos;		
	$vError = new ExcepcionAdministracion;

	

	
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

	

	$s = new Sucursales;
	try{
		$sucursales = $s->getTodos();
	}
	catch(ExcepcionSucursal $es){
		die($es->getMessage());
	}

	$v->sucursales = $sucursales;
	$v-> render();


