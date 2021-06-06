<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Modificar empleados</title>
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
		<!-- Barra con titulo de sección -->		
			<div class= "titulo_seccion"><h2>Modificar datos de empleado</h2></div>

		<!-- Formulario -->
  		<div class="container_form">
			<p>Por favor ingrese los datos del empleado</p>
			<form class="formulario" action="" method="POST">		
						<label for="nombre">Nombre</label>
						<input class="input_general"  type="text" name="nombre" maxlength="20" id="nombre">
						<label for="apellido">Apellido</label>
						<input class="input_general"  type="text" name="apellido" maxlength="20" id="apellido">
						<label for="telefono">Teléfono</label>
						<input class="input_general"  type="text" name="telefono" maxlength="20">
						<label for="direccion">Dirección</label>
						<input class="input_general"  type="text" name="direccion" maxlength="20" id="direccion">
						<label for="cuit">Cuit</label>
						<input class="input_general"  type="text" name="cuit" maxlength="20" id="cuit">
						<label for="sucursal">Sucursal</label>
							<?php
								echo'
									<select class="input_general"  name="sucursal" id="sucursal">';
									foreach ($this->sucursales as $s) {
										echo '<option value="'.$s['id_sucursal'].'">
										'.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
							?>
						</td>
						<label for="usuario">Usuario</label>
						<input class="input_general"  type="text" name="usuario" maxlength="20" id="usuario">
						<label class="input_general"  for="contrasenia">Contraseña</label>
						<input class="input_general"  type="password" name="contrasenia" maxlength="20" id="contrasenia">
						
				
				<input type="hidden" id="hiddenID" name="ID" value="<?=$_GET['e']?>">
				<input class="submit" type="submit" name="setSubmit" value="Guardar">
				<a class="btn btn-primary volver" href="listaEmpleados.php" class="volver">Volver</a>
			</form>
		
		</div>
			
		
		<!-- Pie de pagina -->	
	<footer><h1 class="navbar-brand">CINEMA</h1></footer>
	</div>
	
	
	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>



</html>



