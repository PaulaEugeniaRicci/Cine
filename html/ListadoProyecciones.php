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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  	<title>Proyecciones</title>

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

		
		<!-- Tabla -->
		<div class="container_form">
			<div class="titulo_formulario"><p>LISTADO DE PROYECCIONES </p></div>
				<div class="group_search">
					<form class="form_search" action="listaProyecciones.php" method="POST">
						<input type="submit" name="filtro" value="Dia">
						<input type="submit" name="filtro" value="Semana">
						<input type="submit" name="filtro" value="Mes">
						<input type="submit" name="filtro" value="Ver Todo">
					</form>
					<a class="btn btn-primary" href="altaProyecciones.php" class="">Nueva proyeccion</a>
				</div>
					<table>
						<tr>
							<th>ID</th>
							<th>Pelicula</th>
							<th>Duracion</th>
							<th>Sala</th>
							<th>Sucursal</th>
							<th>Dia y Hora</th>
							<th>Opciones</th>
						</tr>

						<?php
						foreach ($this->proyecciones as $p){
						?>
							<tr class="fila_tabla">
								<td><div class= "celda"><?= $p['id_proyeccion']?></div></td>
								<td><div class= "celda"><?= $p['titulo']?></div></td>
								<td><div class= "celda"><?= $p['duracion']?></div></td>
								<td><div class= "celda"><?= $p['id_sala']?></div></td>
								<td><div class= "celda"><?= $p['descripcion']?></div></td>
								<td><div class= "celda"><?= $p['fecha']?></div></td>	
								<td><div class= "celda"><button name="eliminar" class="btn btn-primary" id="<?=$p['id_proyeccion']?>" >Eliminar</button> </div></td>
									
							</tr>		
						<?php } ?>
					</td>
				</table>
				
		
		</div>





</body>
</html>

<script type="text/javascript">
        $('button[name="eliminar"]').click(function(event){
        	var id_enviar = $(this).attr('id');
				var opcion = confirm("¿Esta seguro que desea eliminar esta proyeccion?");
				if (opcion == true){
					var foo = $(event.target).closest("tr");
					foo.remove();
					$.post('listaProyecciones.php', {id_baja: id_enviar}, function () {
						alert ("La proyeccion ha sido eliminada.");
					});			
    			}
			});   
</script>