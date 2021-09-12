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
  	<title>Agregar nuevo empleado</title>
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

		<!-- Formulario -->
  		<div class="container_form">
			<div class="titulo_formulario"><p>NUEVO EMPLEADO</p></div>
			<form class="formulario" action="" method="POST">
				<div class="bloque_form_columns">		
					<div class="form_column1">	
						<label for="nombre">Nombre</label>
						<input class="input_general" type="text" name="nombre" maxlength="20" id="nombre" required>
						<label for="apellido">Apellido</label>
						<input class="input_general" type="text" name="apellido" maxlength="20" id="apellido" required>
						<label for="telefono">Teléfono</label>
						<input class="input_general" type="text" name="telefono" maxlength="20" required>
						
					</div>
					<div class="form_column2">
						<label for="direccion">Dirección</label>
						<input type="text" name="direccion" maxlength="20" id="direccion" required>
						<label for="cuil">Cuil</label>
						<input class="input_general" type="text" name="cuil" maxlength="20" id="cuil" required>
						<label for="sucursal">Sucursal</label>
							<?php
								echo'
									<select class="input_general" name="sucursal" id="sucursal">
									<option value="" disabled selected></option>';
									foreach ($this->sucursales as $s) {
										echo '<option value="'.$s['id_sucursal'].'">
										'.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
							?>
							</div>
				</div>
				<div class="form_botones">				
				
				<input type="submit" name="setSubmit" value="Guardar" class="btn btn-primary submit">
				<a class="btn btn-secondary volver" href="listaEmpleados.php" class="volver">Volver</a>
				</div>
			</form>
		
		</div>
			
		
		
	</div>
</body>
</html>



