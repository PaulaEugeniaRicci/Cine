<?php

	// ../controllers/altaProyecciones.php

	require'../fw/fw.php';
	require'../models/Proyecciones.php';
	require'../models/Peliculas.php';
	require'../models/Salas.php';
	require'../views/AltaProyecciones.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/
	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['pelicula']))die("Debe seleccionar alguna pelicula.");
		if (empty($_POST['sala']))die ("Debe seleccionar alguna sala.");
		if (empty($_POST['horario']))die("Debe ingresar al menos un horario.");
		if (empty($_POST['fecha1']))die("Debe ingresar la primera fecha de la proyección.");
		if (empty($_POST['fecha2']))die("Debe ingresar hasta que dia se proyectara la pelicula.");
		if (empty($_POST['dias']))die ("Debe ingresar al menos un dia.");
		
		$dias = $_POST['dias'];

		$proyeccion = new Proyecciones;

		try {
			$peli->cargarProyecciones( 
				$_POST['pelicula'],
				$_POST['sala'],
				$_POST['horario'],
				$_POST['fecha1'],
				$_POST['fecha2'],
				$dias
			);
			//header('Location: lista-peliculas'); CAMBIAR CUANDO SE HAGA EL HTACCESS
			//header('Location: listaPeliculas.php');
		}	 			
		catch (ExcepcionProyeccion $e){ 
			die($e->getMessage());
		}
	}


	$p = new Peliculas;
	$s= new Salas;

	try{
		
		$pelis= $p->getTodos();
	}
	catch(ExcepcionPelicula $ep){
		die($ep->getMessage());
	}

	try{
		
		$salas = $s->getTodos();
	}
	catch(ExcepcionSalas $es){
		die($es->getMessage());
	}

		
	
	$v = new altaProyecciones;
	$v->peliculas = $pelis;
	$v->salas = $salas;
	
	$v->render();
