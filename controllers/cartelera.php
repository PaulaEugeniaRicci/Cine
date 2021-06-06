<?php 


require'../fw/fw.php';
require'../models/Peliculas.php';

$pelis = new Peliculas;

/*

if (empty($_POST['sucursal']) && $_POST['subtitulos'] == 0){
	$resultado = $pelis->getPelisNoSubs();

	while($row = $resultado->fetch($resultado)){       
	    array_push($posters, $row);	 	
	}


}



if (empty($_POST['sucursal']) && $_POST['subtitulos'] == 1){
 $resultado = $pelis->getPelisSubs();
	while($row = $resultado->fetch($resultado)){       
	    array_push($posters, $row);	 	
	}

	
}


if (!empty($_POST['sucursal']) && $_POST['subtitulos'] == 0){
	$json = $pelis->getPelisSucNoSubs();
	
	
} 

if (!empty($_POST['sucursal']) && $_POST['subtitulos'] == 1)
{
	$resultado = $pelis->getTodos($_POST['sucursal']);
	while($row = $resultado->fetch($resultado)){       
	    array_push($posters, $row);	 	
	}



}

*/

$json = $pelis->getPelisSucNoSubs();

echo $json;


 ?>