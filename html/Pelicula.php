<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
	<!-- detalles pelicula -->
					<?php foreach ($this->pelicula as $peli){ ?>
					<div class="titulo_pelicula"><h3><?= $peli['titulo'] ?></h3></div>
					<div class="container_pelicula_detalles">		
						
					
						<div class="poster"><img src=" data:image;base64, <?= base64_encode($peli['poster']) ?>" ></div>
						<iframe class="trailer" width="693" height="390" src="https://www.youtube.com/embed/<?= $peli['trailer'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

						<p class="sinopsis"><?= $peli['descripcion'] ?></p>

						<div class="detalles">
				  			<p><b>Genero:</b> <?= $peli['genero'] ?> </p>
				  			<p><b>Duración:</b> <?= $peli['duracion'] ?> Minutos </p>
				  			<p><b>Director:</b> <?= $peli['director'] ?> </p>
				  			<p><b>Clasificación:</b> <?= $peli['descripcion_clasificacion'] ?> </p>
				  			<p><b>Idioma Original:</b> <?= $peli['descripcion_idioma'] ?> </p>
				  			<p><b>Subtitulado:</b> <?= $peli['subtitulado'] ?> </p>
			  			</div>
						
						<form action ="../controllers/entradas.php" s method="GET">				
							<input type="hidden" name="id_pelicula" value="<?= $peli['id_pelicula'] ?>">
							<input type="hidden" name="id_sucursal" value="">		
							<button type="submit" class="btn btn-warning pagar">
							ADQUIRIR ENTRADAS
							</button>	
						</form>
						<a class="btn btn-primary" href="index.php" class="">Volver</a>
					<?php	} ?>
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

<script type="text/javascript">
	$(document).ready(function(){
		var id_sucursal;
	    
	    <?php
	        $id = $this->id_sucursal;
	    ?>	        		
	    id_sucursal = <?=$id?> ;

	    $("input[name='id_sucursal']").val(id_sucursal);
	   	var foo = $("input[name='id_sucursal']").val();
	   	console.log(foo);
		
	});
</script>



