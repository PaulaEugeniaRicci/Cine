<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
      <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>-->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  	<title>Agregar nueva proyección</title>
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
	  		<div class="titulo_formulario"><p>NUEVA PROYECCIÓN</p></div>	
				<form class="formulario" action="" method="POST" >				
					<div class="bloque_form_columns">
						<div class="form_column1">	
					<input type="hidden" name="sucursal" required>

					<label for="pelicula">Pelicula</label>
					<?php
							echo'
								<select class="input_general" name="pelicula" id="pelicula" required> <option value="" disabled selected> </option>';
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
								<select class="input_general"  name="sala" id="sala" required> <option value="" disabled selected> </option>';
								foreach ($this->salas as $s) {
									echo '<option value="'.$s['id_sala'].'">
										'.$s['nombre'].' - '.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
						?>

					<label for="horario">Horarios</label>
						<input class="input_general"  type="time" name="horario"  id="horario" required>

					</div>
					<div class="form_column2">
					<label for="fecha1">Fecha inicial</label>
						<input class="input_general"  type="date" name="fecha1"  id="fecha1" required>

					<label for="fecha2">Fecha final</label>
						<input  class="input_general"  type="date" name="fecha2"  id="fecha2" required>
					</div>
					<div class="form_column3">
					<label for="dias">Días</label>
					<div class="group_checkbox" id="dias">
								<div class="group_checkbox_column1">
									<div>
										<input type="checkbox" name="dias[]" value="1" id="lunes">
										<label for="lunes">Lunes</label>
									</div>
									<div>
										<input class="input_check" type="checkbox" name="dias[]" value="2" id="martes">
										<label for="martes">Martes</label>
									</div>
									<div>
										<input type="checkbox" name="dias[]" value="3" id="miercoles">
										<label for="miercoles">Miercoles</label>
									</div>
									<div>
										<input type="checkbox" name="dias[]" value="4" id="jueves">
										<label for="jueves">Jueves</label>
									</div>
								</div>
								<div class="group_checkbox_column2">
									<div>
										<input type="checkbox" name="dias[]" value="5" id="viernes">
										<label for="viernes">Viernes</label>
									</div>
									<div>
										<input type="checkbox" name="dias[]" value="6" id="sabado">
										<label for="sabado">Sabado</label>
									</div>
									<div>
										<input type="checkbox" name="dias[]" value="7" id="domingo">
										<label for="domingo">Domingo</label>
									</div>
								</div>
							</div>
					
					</div>
					</div>
					<div class="form_botones">
						<input type="submit" name="setSubmit" value="Guardar" class="submit btn btn-primary">
						<a class="btn btn-secondary volver" href="listaProyecciones.php" class="">Volver</a>
					</div>
				</form>
				
			</div>
			
			
		</div>
</body>
</html>




