<?php

	// ../controllers/pagos.php

	require'../fw/fw.php';
	require'../models/Pagos.php';
	require'../models/Proyecciones.php';
	require'../models/Sucursales.php';
	require'../views/VistaPagos.php';
	require'../views/PagoOk.php';
	require'../views/PagoFail.php';
	require'../views/ExcepcionCliente.php';

	$proy = new Proyecciones;
	$suc = new Sucursales;
	$v = new VistaPagos;
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
		if (!empty($_POST['monto_total'])){
			//var_dump($_POST['monto_total']);
			$v->monto = $_POST['monto_total'];
		}
		
	}


	//Metodos de marco p/validar tarjeta
	if(isset($_POST['nro_tarjeta']) and $_POST['cant_entradas']>0){
		
		//VALIDACIONES DEL INPUT - Si evade el require de los campos
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del cliente.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del cliente.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['email']))die("Debe ingresar email del cliente.");
		if (empty($_POST['dni'])) die("Debe ingresar un DNI valido.");
		
		$nro_tarjeta = $_POST['nro_tarjeta'];
		$digito = substr($nro_tarjeta, 0, 1);
		$seguridad = strlen($_POST['seguridad']);

		$pagos = new Pagos();

		try{
			$pagos->verificarPago(
				$nro_tarjeta,
				$digito,
				$seguridad,
				$_POST['metodo'],
				$_POST['caducidad']
			);
		}
		catch (ExcepcionPago $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit(); 
		}

		
		try{
			$pagos-> cargarClientes(
				$_POST['dni'],
				$_POST['nombre'],
				$_POST['apellido'],
				$_POST['telefono'],
				$_POST['email']
			);
		}
		catch (ExcepcionPago $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit(); 
		}
		try {
			$pagos->cargarPagos(
				$_POST['metodo'],
				$nro_tarjeta,
				$_POST['monto_total'],
				$_POST['dni'],
				$_POST['id_proy'],
				$_POST['cant_entradas']
			);
			$v = new PagoOk;
		}
		catch (ExcepcionPago $e){ 
			$vError->mensaje = $e->getMessage();
			$vError->enlace = 'index.php';
			$vError-> render();
			exit(); 
		}
	}

	$v-> render();



