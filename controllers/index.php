<?php

// ../controllers/index.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../models/Sucursales.php';
	require'../models/Generos.php';
	require'../views/Index.php';

	$pelis = new Peliculas;			// Un modelo
	$suc = new Sucursales;
	$v = new Index;		// Vista, se carga con lo obtenido de modelos
	
	if(isset($_POST['id_sucursal']) && $_POST['id_sucursal'] != 0){

		try{ 
				$todosPelis = $pelis->getPelisSucursal(); 
				$todosSuc= $suc->getTodos();
				$v->peliculas = $todosPelis;
				$v->sucursales = $todosSuc;
				
				
			}
			catch (ExcepcionPelicula $e){ 
				die($e->getMessage()); 
			}
	}

	if(!isset($_POST['id_sucursal']) or $_POST['id_sucursal'] == 0){

		try{ 
				$todosPelis = $pelis->getTodos(); 
				$todosSuc= $suc->getTodos();
				$v->peliculas = $todosPelis;
				$v->sucursales = $todosSuc;
				
				
			}
			catch (ExcepcionPelicula $e){ 
				die($e->getMessage()); 
			}
		}	


	$v-> render();


