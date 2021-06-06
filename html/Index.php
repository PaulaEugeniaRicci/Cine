<!doctype html>
<html lang="en">
  <head>
     <!-- Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
 	 
    <title>Cinema</title>
  
  </head>
  <body>

<div class= "container_index">
	
	<!-- Barra de navegación principal -->

	<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #000000;">
  <a class="navbar-brand" href="../controllers/index.php">CINEMA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Anuncios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../controllers/listaEmpleados.php">Empleados<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Peliculas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Proyecciones</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

	

<!-- Carrusel de imagenes -->

	   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="https://static.cinepolis.com.ar/backdrops/1394/original/BannerWEB-2048x1024-DemonSlayer_YC_2.jpeg">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://static.cinepolis.com.ar/backdrops/1394/original/BannerWEB-2048x1024-DemonSlayer_YC_2.jpeg">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://static.cinepolis.com.ar/backdrops/1394/original/BannerWEB-2048x1024-DemonSlayer_YC_2.jpeg">
	    </div>
	  </div>

	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>

	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>

	</div>



<!-- Cartelera -->
<div class= "cartelera" > 
	<div class = "cabecera_cartelera">
		<h1 class="titulo_cartelera" id="peliculas">PELICULAS</h1>
		<span class="items_cartelera">
				<!-- Formulario de selector de sucursal -->
			<form action="" class ="formulario_select_sucursal"  method="POST">
					 <select name= "sucursal" id="select_form_sucursal">
						<option value="" disabled selected>Seleccionar complejo...</option>
						<?php foreach ($this->sucursales as $suc) {
						?>		<option value="<?= $suc['id_sucursal'] ?>">Cinema <?= $suc['localidad']?></option>
						<?php } ?>
					</select>
			</form>


			<form action="" method="POST" >
				<input type="hidden" name="id_sucursal" value="0">
				<button type="submit" class="boton_verTodo"> Ver Todo</button>
			</form>
		
		</span>
	</div>

	<!-- Posters con sus titulos -->
	<div class="posters" >
		<?php foreach ($this->peliculas as $p) { ?>
		<form action ="../controllers/pelicula.php" class="form_cartelera" method="POST">				
			<input type="hidden" name="id_pelicula" value="<?= $p['id_pelicula'] ?>">		
			<div class = "peli_cartelera">
				<button type="submit" class="boton_poster">	
					<div class="box_img">
					   	<img src="data:image;base64, <?= base64_encode($p['poster']) ?>">
					<div class="texto_poster">
						<?= $p['titulo'] ?> 
					</div>							 	
				</button>
			</div>		
		</form>
		<?php } ?>
	</div>

	<div class="posters" id="posters">
		
		
	</div>



</div>

<!-- Pie de pagina -->	
	<footer>
		<h1 class="navbar-brand">CINEMA</h1>
		<a href="../controllers/login.php"><img src="../img/login.png" title="Acceso de personal"></a>
	</footer>
</div>
	
	<script>
		document.getElementById('select_form_sucursal').onchange = function(){
			this.form.submit();
		}
	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>