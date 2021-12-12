<?php

// ../controllers/login.php

session_start();
require '../fw/fw.php';
require '../models/Usuarios.php';
require '../views/Login.php';
require'../views/ExcepcionAdministracion.php';



$v = new Login;

if(isset($_POST['email']) and isset($_POST['password'])){
	/*/Validaciones
	if(strlen($email) < 5 || strlen($email) > 30)
    {
    	$vError = new ExcepcionAdministracion;
    	$vError->mensaje = "Error: email fuera de rango.";
		$vError->enlace = 'login.php';
		$vError-> render();
		exit();
    }*/
  	$usuario = new Usuarios;

	if ($usuario ->validarSesion($_POST['email'], $_POST['password'])){
		$_SESSION['login'] = true;    
	    header("Location: listaEmpleados.php");
	    exit;
	}
	else { $v->error = true; }
}

$v->render();