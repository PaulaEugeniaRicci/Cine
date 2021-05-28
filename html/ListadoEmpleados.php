<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Lista de empleados</title>

	<script src="http://localhost:8080/Proyecto/html/Script.php"></script>
</head>
<body>

	<div class="container_alter_tablas">
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
		<div class= "titulo_seccion"><h2>LISTADO DE EMPLEADOS</h2></div>

		<!-- Tabla -->
		<div class="container_form">
			<div class="card">
				<div class="card-body">
					<form class="form-group" action="listaEmpleados.php" method="POST">
						
						<input type="text" name="valor" class="txtSize" placeholder="Buscar empleados: por CUIT o por Apellido" size="20" maxlength="20">
						<input type="submit" value="Buscar">

					</form>

					<form class="form-group" action="listaEmpleados.php" method="POST">
						<?php
								echo'
									<select name="sucursal" id="sucursal">
									<option value= "" disabled selected >Buscar por sucursal</option>';
									foreach ($this->sucursales as $s) {
										echo '<option value="'.$s['id_sucursal'].'">
										'.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
						?>
						<input type="submit" name="setSubmit" value="Buscar">

					</form>


					<table class="table table-dark" border="1">
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>CUIT</th>
							<th>Direccion</th>
							<th>Telefono</th>
							<th>Sucursal</th>
							<th>Opciones</th>
						</tr>
						<?php
						foreach ($this->empleados as $e) 
						{
							echo'<tr>
									<td>'.$e['id_empleado'].'</td>
									<td>'.$e['nombre'].'</td>
									<td>'.$e['apellido'].'</td>
									<td>'.$e['cuit'].'</td>
									<td>'.$e['direccion'].'</td>
									<td>'.$e['telefono'].'</td>
									<td>'.$e['descripcion'].'</td>
									<td>
										<button class="btn btn-primary" onclick="borrarRegistro(this.name)" name= '.$e['id_empleado'].'>Eliminar</button>
										
										<a href=modificarEmpleados.php?e='.$e['id_empleado'].' class="btn btn-primary">Modificar</a>
									</td>					
								</tr>';			
						}
						?>
					<form action="bajaEmpleados.php" method="POST" id="hiddenform">
						<input type="hidden" id="hiddenID" name="ID" value="">
						<input type="submit" id="enviar" style="visibility: hidden;">
					</form>

					</table>
					<a class="btn btn-primary" href="altaEmpleados.php" class="">Nuevo Empleado</a>
				</div>
			</div>
		</div>

			<footer><h1 class="navbar-brand">CINEMA</h1></footer>
	</div>

	<!-- Pie de pagina -->	
	
	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
