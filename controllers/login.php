<?php

// ../controllers/login.php

session_start();
require '../fw/fw.php';
require '../models/Usuarios.php';
require '../views/Login.php';



$v = new Login;

if(isset($_POST['email'])){
  if(!isset($_POST['password'])) die("Error: debe ingresar su contraseña.");
  if((new Usuarios)->validarSesion($_POST['email'], $_POST['password'])) {
    // Determina si el usuario inicio sesion o no
    $_SESSION['login'] = true;

    header("Location: listaEmpleados.php");
    exit;
  }
  else
  {
    $v->error = true;
  }
  
}

$v->render();