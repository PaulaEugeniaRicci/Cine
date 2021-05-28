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
			  			<form class="form_compra"action="../controllers/pagos.php" method="POST">

			  				<!-- sucursal -->
							 <select class="entrada_sucursal" name= "sucursal">
								<option value="" disabled selected>Seleccionar sucursal</option>
							 <?php foreach ($this->sucursales as $suc) {
				?>		       <option value="<?= $suc['id_sucursal'] ?>"> <?= $suc['localidad']?></option>
				<?php } ?>  </select>
							
							<!-- fechas  -->
							<div class="container_fechas">
							<label for="day1" class="lbl-fecha"> <span class="dia">Lunes</span><span>Mayo</span><span>24</span></label>
							<input type="radio" class="radio" name="options" id="day1" >
							<label for="day2" class="lbl-fecha"> <span class="dia">Martes</span> <span>Mayo </span><span>25</span></label>
							<input type="radio" class="radio" name="options" id="day2" autocomplete="off">
							<label for="day3" class="lbl-fecha"> <span class="dia">Miercoles</span> <span>Mayo</span><span> 26</span></label>
							<input type="radio" class="radio" name="options" id="day3" autocomplete="off">
							<label for="day4" class="lbl-fecha"> <span class="dia">Jueves</span> <span>Mayo </span><span>27</span></label>
							<input type="radio" class="radio" name="options" id="day4" autocomplete="off">
							<label for="day5" class="lbl-fecha"> <span class="dia">Viernes</span><span>Mayo </span><span>28</span></label>
							<input type="radio" class="radio" name="options" id="day5" autocomplete="off">
							<label for="day6" class="lbl-fecha"> <span class="dia">Sabado</span> <span>Mayo </span>29</span></label>
							<input type="radio" class="radio" name="options" id="day6" autocomplete="off">
							<label for="day7" class="lbl-fecha"><span class="dia">Domingo</span> <span>Mayo</span> <span>30</span></label>
							<input type="radio" class="radio" name="options" id="day7" autocomplete="off">
							</div>
				
					<?php	} ?>

					<!-- horarios  -->
							<div class="horarios">
							<label for="hora1" class="lbl-horario"> 10:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora1" autocomplete="off">
							<label for="hora2" class="lbl-horario"> 12:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora2" autocomplete="off">
							<label for="hora3" class="lbl-horario"> 14:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora3" autocomplete="off">
							<label for="hora4" class="lbl-horario">16:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora4" autocomplete="off">
							<label for="hora5" class="lbl-horario"> 18:00</label>
							<input type="radio" class="btn-check radio" name="options" id="hora5" autocomplete="off">
							<label for="hora6" class="lbl-horario"> 20:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora6" autocomplete="off">
							<label for="hora7" class="lbl-horario"> 22:00 </label>
							<input type="radio" class="btn-check radio" name="options" id="hora7" autocomplete="off">
							</div>

						 	<label for="cantidad">Cantidad:</label>
							<input type="number" name="cantidad" min="1" value="1" class="cantidad_entradas" id="cantidad">

							<button type="submit" class="btn btn-warning pagar">CONFIRMAR COMPRA</button>
						</form>
					</div>
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



