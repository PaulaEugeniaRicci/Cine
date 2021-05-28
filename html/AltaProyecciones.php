<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Agregar proyección</title>
</head>
<body>

		<div class="container_alternative">
	<!-- Barra de navegación principal -->
		  	<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #000000;">
			  	<div class="container-fluid">
					  <a class="navbar-brand" href="#">CINEMA</a>
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
	<!-- Barra con titulo de sección -->	
			<div class= "titulo_seccion"><h2>ALTA DE PROYECCIONES</h2></div>
	<!-- formulario -->
			<div class="container_form">
	  			<p>Por favor ingrese los datos de la proyección</p>
				<form class="formulario" action="" method="POST" >				
						
					<input type="hidden" name="sucursal" required>

					<label for="pelicula">Pelicula</label>
					<?php
							echo'
								<select name="pelicula" id="pelicula" required> <option value="" disabled selected> </option>';
								foreach ($this->peliculas as $p) {
									echo '<option value="'.$p['id_pelicula'].'">
										'.$p['titulo'].'
										</option>';
									}
								echo'</select>'
						?>
					
					<label for="sala">Sala</label>
						<?php
							echo'
								<select name="sala" id="sala" required> <option value="" disabled selected> </option>';
								foreach ($this->salas as $s) {
									echo '<option value="'.$s['id_sala'].'">
										'.$s['nombre'].' - '.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
						?>

					<label for="horario">Horarios</label>
						<input type="time" name="horario"  id="horario" required>

					<label for="fecha1">Fecha inicial</label>
						<input type="date" name="fecha1"  id="fecha1" required>

					<label for="fecha2">Fecha final</label>
						<input type="date" name="fecha2"  id="fecha2" required>

					<fieldset>
							<legend>Dias</legend>
							<input type="checkbox" name="dias[]" value="0">Lunes<br>
							<input type="checkbox" name="dias[]" value="1">Martes<br>
							<input type="checkbox" name="dias[]" value="2">Miercoles<br>
							<input type="checkbox" name="dias[]" value="3">Jueves<br>
							<input type="checkbox" name="dias[]" value="4">Viernes<br>
							<input type="checkbox" name="dias[]" value="5">Sabado<br>
							<input type="checkbox" name="dias[]" value="6">Domingo<br>
					</fieldset>
					
					<input type="submit" name="setSubmit" value="Guardar" class="submit">
					<a class="btn btn-primary volver" href="" class="">Volver</a>
				</form>
				
			</div>
			
			<footer><h1 class="navbar-brand">CINEMA</h1></footer>
		</div>



	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>



</html>



