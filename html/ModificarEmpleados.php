<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="../html/style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
      <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  	<title>Modificar empleados</title>
</head>
<body>

	<!-- Barra de navegación principal -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navCinema" >
  		<a class="navbar-brand" href="../controllers/index.php">CINEMA</a>
		</nav>
		
		<!-- main -->
		<div class="container-fluid fixContainer">
		<div class="row">
			<div class="col-2 p-0 navbar_dev_container d-none d-lg-block"> <!-- menu admin -->
				<nav class="container navbar_dev  ">								
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono fas fa-users"></i></div><a href="../controllers/listaEmpleados.php">Empleados</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono fas fa-film"></i></div><a href="../controllers/listaPeliculas.php">Peliculas</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono fas fa-door-open"></i></div><a href="../controllers/listaSalas.php">Salas</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono far fa-calendar-alt"></i></div><a href="../controllers/listaProyecciones.php">Proyecciones</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono fas fa-ticket-alt"></i></div><a href="../controllers/listaPrecios.php">Tarifas</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono far fa-money-bill-alt"></i></div><a href="../controllers/recaudacion.php">Recaudaci&oacuten</a>
					</div>
					<div class="dev_item_link">
						<div class="cont_icon"><i class="icono fas fa-user-shield"></i></div><a href="../controllers/administracion.php">Administraci&oacuten</a>
					</div>				
				</nav>
			</div>



			<div class="col-12 col-lg-10 "> <!-- zona forms y tablas -->
				<div class="titulo-formulario p-2 mt-2 text-center"><h4>MODIFICAR EMPLEADO</h4></div>
			<form class="formulario" action="" method="POST">
				<?php foreach ($this->empleados as $e){ ?>
				<div class="bloque_form_columns">
					<div class="form_column1">	
						<label for="nombre">Nombre</label>
						<input class="input_general"  type="text" name="nombre" value="<?= $e['nombre'] ?>" required>
						<label for="apellido">Apellido</label>
						<input class="input_general"  type="text" name="apellido" value="<?= $e['apellido'] ?>" required>
						<label for="telefono">Teléfono</label>
						<input class="input_general"  type="text" name="telefono" value="<?= $e['telefono'] ?>" required>
						
					</div>
					<div class="form_column2">
						<label for="direccion">Dirección</label>
						<input class="input_general"  type="text" name="direccion" value="<?= $e['direccion'] ?>" required>
						<label for="cuil">Cuil</label>
						<input class="input_general"  type="text" name="cuil" value="<?= $e['cuil'] ?>" required>
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
				<?php } ?>

				</div>	

				</div>
				<div class="form_botones">
				<input type="submit" name="setSubmit" value="Guardar" class="submit btn btn-primary">
				<a class="btn btn-outline-secondary volver" href="listaEmpleados.php" class="volver">Volver</a>
			</div>
			</form>
		
		</div>
			
		

	</div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
	    var foo;
	    <?php
	       	foreach ($this->empleados as $e){
	    ?>	        		
	        foo = <?=$e['id_sucursal']?>;
	    <?php } ?>

	    $('#sucursal').val(foo);
    })
</script>

