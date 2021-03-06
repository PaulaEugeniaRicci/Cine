<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
     <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
  	<title>Agregar pelicula</title>
</head>
<body>

		<div class="container_alternative">
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

	<!-- menu de admin -->
			<div class="navbar_dev">
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-users"></i></div><a href="../controllers/listaEmpleados.php">Empleados</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-film"></i></div><a href="../controllers/listaPeliculas.php">Peliculas</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-film"></i></div><a href="../controllers/listaSalas.php">Salas</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono far fa-calendar-alt"></i></div><a href="../controllers/listaProyecciones.php">Proyecciones</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-ticket-alt"></i></div><a href="../controllers/listaPrecios.php">Tarifas</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-film"></i></div><a href="../controllers/listaPrecios.php">Recaudaci&oacuten</a>
				</div>
				<div class="dev_item_link">
					<div class="cont_icon"><i class="icono fas fa-film"></i></div><a href="../controllers/listaPrecios.php">Administraci&oacuten</a>
				</div>
			</div>

	<!-- formulario -->
			<div class="container_form">
	  			<div class="titulo_formulario"><p>NUEVA PELICULA</p></div>
				<form class="formulario" action="" method="POST" enctype="multipart/form-data">			<div class="bloque_form_columns">		
						<div class="form_column1">	
						
						<label for="titulo">Titulo</label>
						<input class="input_general" type="text" name="titulo" id="titulo" required>			

						
					<label for = "director">Director</label>
						<input  class="input_general" type="text" name="director" id="Director" required></td>
						
						<label for="clasificacion">Clasificación</label>
								<?php
									echo'
										<select class="input_general" name="clasificacion"> <option value="" disabled selected> </option>';
										foreach ($this->clasificaciones as $c) {
											echo '<option value="'.$c['id_clasificacion'].'">
											'.$c['descripcion_clasificacion'].'
											</option>';
										}
									echo'</select>'
								?>
								
						<label for="duracion">Duración</label>
						<input  class="input_general" type="number" name="duracion" min="20" max="240" value="20" id="duracion">

						
						</div>
						<div class="form_column2">	
						<label  for="idioma">Idioma</label>
								<?php
									echo'
										<select class="input_general" name="idioma" id="idioma"> <option value="" disabled selected> </option>';
										foreach ($this->idiomas as $i) {
											echo '<option value="'.$i['id_idioma'].'">
											'.$i['descripcion_idioma'].'
											</option>';
										}
									echo'</select>'
								?>

						<label for="Subtitulos">Subtitulos</label>
						<select class="input_general" name="subtitulado" id="subtitulos">
							<option value="" disabled selected></option>
							<option value="Doblado">Doblado</option>
							<option value="Subtitulado">Subtitulado</option>
						</select>
							
						<label for="sinopsis">Sinopsis</label>
						<textarea class="input_general" name="sinopsis" required></textarea>

						<label for="fecha">Fecha de estreno</label>
						<input class="input_general" type="date" name="fecha" id="fecha" required>

						</div>

						<div class="form_column3">

						<label for="genero">Genero</label>
						<div class="group_checkbox" id="genero">
							<div class="group_checkbox_column1">
								<div><input class="input_check" type="checkbox" name="genero[]" value="5" id="accion">
								<label for="accion">Acción</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="6" id="animacion">
								<label for="animacion">Animación</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="2" id="comedia">
								<label for="comedia">Comedia</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="4" id="crimen">
								<label for="crimen">Crimen</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="10" id="documental">
								<label for=documental>Documental</label></div>
							</div>
							<div class="group_checkbox_column2">
								
								<div><input class="input_check" type="checkbox" name="genero[]" value="1" id="drama">
								<label for="drama">Drama</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="9" id="romance">
								<label for="romance">Romance</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="7" id="terror">
								<label for="terror">Terror</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="3" id="thriller">
								<label for="thriller">Thriller</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="8" id="western">	
								<label for="western">Western</label></div>	
							</div>
						</div>

						<label for="trailer">Trailer</label>
						<input class="input_general" type="text" name="trailer" id="trailer" placeholder="www.youtube.com/watch?v=(ESTE CODIGO)" required>

						<label for="poster">Poster</label>
						<input  class="input_general" type="file" name="poster" required>		
					
				</div>
					</div>	

					<div class="form_botones">
					<input type="submit" name="setSubmit" value="Guardar" class="submit btn btn-primary">
					<a class="btn btn-secondary volver" href="listaPeliculas.php" class="">Volver</a>
					</div>
				</form>
				
			</div>
			
			
		</div>
</body>
</html>



