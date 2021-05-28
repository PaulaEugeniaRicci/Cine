<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Agregar pelicula</title>
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
			<div class= "titulo_seccion"><h2>ALTA DE PELICULAS</h2></div>
	<!-- formulario -->
			<div class="container_form">
	  			<p>Por favor ingrese los datos de la pelicula</p>
				<form class="formulario" action="" method="POST" enctype="multipart/form-data">				
						
						<label for="titulo">Titulo</label>
						<input type="text" name="titulo" maxlength="60" id="titulo" required>
						
						<fieldset>
							<legend>Género</legend>
							<?php
								foreach ($this->generos as $g) {
												echo '<input type="checkbox" name="genero[]" value="'.$g['id_genero'].'">
												'.$g['descripcion_genero'].'
												<br>';
											}
							?>
						</fieldset>

						
					<label for = "director">Director</label>
						<input type="text" name="director" maxlength="20" id="Director" required></td>
						
						<label for="clasificacion">Clasificación</label>
								<?php
									echo'
										<select name="clasificacion"> <option value="" disabled selected> </option>';
										foreach ($this->clasificaciones as $c) {
											echo '<option value="'.$c['id_clasificacion'].'">
											'.$c['descripcion_clasificacion'].'
											</option>';
										}
									echo'</select>'
								?>
								
						<label for="duracion">Duración</label>
						<input type="number" name="duracion" min="20" max="240" value="20" id="duracion">

						<label for="idioma">Idioma</label>
								<?php
									echo'
										<select name="idioma" id="idioma"> <option value="" disabled selected> </option>';
										foreach ($this->idiomas as $i) {
											echo '<option value="'.$i['id_idioma'].'">
											'.$i['descripcion_idioma'].'
											</option>';
										}
									echo'</select>'
								?>

						<label for="Subtitulos">Subtitulos</label>
						<select name="subtitulado" id="subtitulos">
							<option value="" disabled selected>-</option>
							<option value="No">No</option>
							<option value="Si">Si</option>
						</select>
							
						<label for="sinopsis">Sinopsis</label>
						<textarea name="sinopsis" required></textarea>

						<label for="fecha">Fecha de estreno</label>
						<input type="date" name="fecha" id="fecha" required>

						<label for="trailer">Trailer</label>
						<input type="text" name="trailer" id="trailer" placeholder="www.youtube.com/watch?v=(ESTE CODIGO)" required>

						<label for="poster">Poster</label>
						<input type="file" name="poster" required>		
					
					<input type="submit" name="setSubmit" value="Guardar" class="submit">
					<a class="btn btn-primary volver" href="listaPeliculas.php" class="">Volver</a>
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



