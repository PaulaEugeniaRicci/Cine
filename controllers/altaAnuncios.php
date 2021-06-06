<?php

	// ../controllers/altaAnuncios.php

	require'../fw/fw.php';
	require'../models/Anuncios.php';
	require'../views/AltaAnuncios.php';

	/*
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login");
		exit;
	}
	*/
	if (isset($_FILES['imagen'])){

	$imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name'])); 
		
			$anuncios = new Anuncios();

		try {
			$anuncios->cargarAnuncio( $imagen);
			//header('Location: lista-anuncios'); CAMBIAR CUANDO SE HAGA EL HTACCESS
			header('Location: listaAnuncios.php');
		}
		catch (ExcepcionAnuncios $ep){ 
			die($ep->getMessage());
		}
	}else{
		$v = new AltaAnuncios;
		$v->render();

	}

	

	