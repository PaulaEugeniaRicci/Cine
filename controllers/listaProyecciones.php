<?php

	// ../controllers/listaProyecciones.php

	require'../fw/fw.php';
	require'../models/Proyecciones.php';
	require'../models/Peliculas.php';
	require'../models/Salas.php';
	require'../views/ListadoProyecciones.php';
	require'../views/ExcepcionAdministracion.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}*/

	$pp = new Proyecciones;
	$p = new Peliculas;
	$s= new Salas;
	$vError = new ExcepcionAdministracion;
	
	//Borrar
	if (!empty($_POST["id_baja"])){
		try {
			$pp->borrarProyecciones($_POST["id_baja"]);
		}
		catch(ExcepcionProyecciones $epp){
			$vError->mensaje = $epp->getMessage();
			$vError->enlace = 'listaProyecciones.php';
			$vError-> render();
			exit();
		}
	}

	// Si el usuario eligió filtrar	
	if (isset($_POST['filtro'])){
		try {
			if (($_POST["filtro"]) == 'Ver Todo') {$proyecciones = $pp->getTodos();}
			if (($_POST["filtro"]) == 'Dia') {$proyecciones = $pp->getProyeccionesByFecha(1);}
			if (($_POST["filtro"]) == 'Semana') {$proyecciones = $pp->getProyeccionesByFecha(2);}
			if (($_POST["filtro"]) == 'Mes') {$proyecciones = $pp->getProyeccionesByFecha(3);}	
		}	
		catch(ExcepcionProyecciones $epp){ 
			$vError->mensaje = $epp->getMessage();
			$vError->enlace = 'listaProyecciones.php';
			$vError-> render();
			exit();
		}
	}
	
	//Y si no eligió filtrar, le mostramos todos
	else{ 
		try{
			$proyecciones = $pp->getTodos(); 
		}
		catch(ExcepcionProyecciones $epp){
			$vError->mensaje = $epp->getMessage();
			$vError->enlace = 'listaProyecciones.php';
			$vError-> render();
			exit();
		}
	}

	try{		
		$pelis= $p->getTodos();
	}
	catch(ExcepcionPelicula $ep){
		$vError->mensaje = $ep->getMessage();
		$vError->enlace = 'listaProyecciones.php';
		$vError-> render();
		exit();
	}

	try{	
		$salas = $s->getTodos();
	}
	catch(ExcepcionSalas $es){
		die($es->getMessage());
	}

	$v = new ListadoProyecciones;
	$v->peliculas = $pelis;
	$v->salas = $salas;
	$v->proyecciones = $proyecciones;
	$v->render();
	
	
	