<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="../html/style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Pelicula</title>
</head>
<body>

		<div class="container_pelicula">
	<!-- Barra de navegación principal -->
		  	<nav class="navbar fixed-top navbar-expand-lg navbar-dark" >
			  	<div class="container-fluid">
					  <a class="navbar-brand" href="../controllers/index.php">CINEMA</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>

					 <div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">      	
							</li>
						 </ul>
					 </div>
				</div>
			</nav>
	<!-- Notificacion en vez de posters -->
	<div class="container_form">
				<div class="notificacion">
				  		<div class="mensaje"><p><?=$this->mensaje?></p><a class="btn btn-primary volver" href="<?=$this->enlace?>" class="volver">Volver</a></div>
			</div>	
		</div>	
				
</div>
 	<!-- Pie de pagina-->
			<footer><div class="creditos">
		<h5>CINEMA</h5>
		
		</div>
		<div class="footer_login">
			<a href="../controllers/listaPeliculas.php"><img src="../img/login.png" title="Acceso de personal"></a>
		</div></footer>
		</div>

</body>



</html>