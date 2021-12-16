<?php

// ../controllers/pelicula.php

	require'../fw/fw.php';
	require'../models/Peliculas.php';
	require'../views/Pelicula.php';
	require'../views/ExcepcionCliente.php';

	$vError = new ExcepcionCliente;		
	$v = new Pelicula;	

	if(isset($_POST['id_pelicula'])){

		$pelis = new Peliculas;
		$id_sucursal = ($_POST['id_sucursal']);			
		$v->id_sucursal = $id_sucursal;

		try{ 
			$datos_peli = $pelis->getPelicula($_POST['id_pelicula']);
		}
		catch (ExcepcionPelicula $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit();
		}	
	}
	
		
	$v->pelicula = $datos_peli ;
	$v-> render();


