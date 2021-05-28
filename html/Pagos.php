<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Pelicula</title>
</head>
<body>

		<div class="container_pelicula">
	<!-- Barra de navegación principal -->
		  	<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #000000;">
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
					<div class="titulo_seccion"> <h3>Entradas para: <?= $peli['titulo'] ?></h3></div>
					<div class="container_pelicula_entradas">	
						<img src=" data:image;base64, <?= base64_encode($peli['poster']) ?>" class="poster">
						
						<div class="detalles">
				  			<p><b>Genero:</b> <?= $peli['genero'] ?> </p>
				  			<p><b>Duración:</b> <?= $peli['duracion'] ?> Minutos </p>
				  			<p><b>Idioma Original:</b> <?= $peli['descripcion_idioma'] ?> </p>
				  			<p><b>Subtitulado:</b> <?= $peli['subtitulado'] ?> </p>
			  			</div>
			  			
			  				<!-- detalle de compra -->
			  				<p>Pelicula:</p>
							<p>Sucursal:</p>
							<p>Sala:</p>
							<p>Asientos:</p>
							<p>Dia y horario:</p>
							<p>Cantidad de entradas</p>

						<form action="" class="form_pago" method="post">
							<input type="hidden" name="pelicula" value="">
							<input type="hidden" name="sucursal" value="">
							<input type="hidden" name="sala" value="">
							<input type="hidden" name="asientos" value="">
							<input type="hidden" name="fecha" value="">
							<input type="hidden" name="horario" value="">

							<button type="submit" class="btn btn-warning pagar">CONFIRMAR PAGO</button>
						</form>
					</div>

				<?php } ?>
 	<!-- Pie de pagina-->
			<footer><h1 class="navbar-brand">CINEMA</h1></footer>
		</div>

	
	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>



</html>



