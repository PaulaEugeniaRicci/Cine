<?php

// ../controllers/pagos.php
	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/

	require'../fw/fw.php';
	require'../models/Proyecciones.php';
	require'../models/Sucursales.php';
	require'../views/Pagos.php';
	//vistas de errores/notificaciones... 
	require'../views/PagoOk.php';
	require'../views/PagoFail.php';
	require'../views/ExcepcionCliente.php';

	$proy = new Proyecciones;
	$suc = new Sucursales;
	$v = new Pagos;
	$vError = new ExcepcionCliente;	

	//Cambie a proyeccion, no deberia ir pelicula
	if(isset($_POST['id_proy'])){
		try{ 
			$proy = $proy->getPeliProyeccion($_POST['id_proy']); 
			$v->pelicula = $proy;
		}
		catch (ExcepcionProyeccion $ep){ 
			$vError->mensaje = $ep->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit();
		}
		try{
			$suc = $suc->getById($_POST['sucursal']);
			$v->sucursal = $suc[0]["descripcion"];
		}
		catch(ExcepcionSucursal $es){ 
			$vError->mensaje = $es->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit();
		}
		$v->cant_entradas = $_POST['cant_entradas'];
		//$v->monto = $_POST['monto'];
		if (!empty($_POST['monto_total'])){
			//var_dump("hola!!");
			var_dump($_POST['monto_total']);
			$v->monto = $_POST['monto_total'];
		}
		
	}


	/*Metodos de marco p/validar tarjeta
	if(isset($_POST['nro_tarjeta'])){
		$peli = $pelis->getPelicula($_POST['id_pelicula']); 
				

		$nro_tarjeta = $_POST['nro_tarjeta'];
		$digito = substr($nro_tarjeta, 0, 1);
		$seguridad = strlen($_POST['seguridad']);
		$metodo = $_POST['metodo'];

		if(strlen($nro_tarjeta)==16){
			$v = new PagoFail; $v->pelicula = $peli;

			$nombre= $_POST['nombre'];
			$apellido= $_POST['apellido'];
			$dni= $_POST['dni'];
			//$proyeccion = $_POST['proyeccion'];
			//$sala= $_POST['sala'];
			$fecha = $_POST['fecha'];
			$horario= $_POST['horario'];
			//$entradas = $_POST['entradas'];
			//$pago = $_POST['pago'];

			if($metodo == 1 && $digito == 4 && $seguridad == 3){
				//$pagos = new Pagos();
				//$pagos->agregarPago();
					//aqui quizas una funcion que retorne el comprobante
				$v = new PagoOk;
				$v->pelicula = $peli;
			}

			if($metodo == 2 && $digito == 5 && $seguridad == 3){
				$v = new PagoOk;
				$v->pelicula = $peli;
			}
		}
	}*/


	$v-> render();



