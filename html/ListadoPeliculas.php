<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="../html/style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	  <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
  	<title>Lista de peliculas</title>
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
				<table class="table mt-2">
					<tr>
					<th colspan="10" class="titulo-formulario">
						<h4>LISTADO DE PELICULAS</h4>
					</th>
					</tr>

					<tr>
					<th colspan="10">
						<form class="form_search mt-1 mb-1" action="listaPeliculas.php" method="POST">
							<input type="text" name="valor" class="txtSize input_general" placeholder="Buscar por titulo" size="20" maxlength="20">
						<?php
						echo'
							<select class="input_general" name="clasificacion" id="clasificacion">
								<option value= "" disabled selected >Buscar por clasificacion</option>';
								foreach ($this->clasificaciones as $c) {
							echo '<option value="'.$c['id_clasificacion'].'">
								'.$c['descripcion_clasificacion'].'
								</option>';
									}
						echo'</select>'
															?>
							<input type="submit" name="setSubmit" value="Buscar">
							<a class="btn btn-primary" href="altaPeliculas.php" class="">Nueva Pelicula</a>
						</form>
					</th>
					</tr>

					<tr>
					<th scope="col">ID</th>
					<th scope="col">Titulo</th>
					<th scope="col">Genero</th>
					<th scope="col">Director</th>
					<th scope="col">Clasificacion</th>
					<th scope="col">Duracion</th>
					<th scope="col">Idioma Original</th>
					<th scope="col">Subtitulado</th>
					<th scope="col">Descripcion</th>
					<th scope="col">Opciones</th>
					</tr>
						<?php
						foreach ($this->peliculas as $p) 
					{
						echo'<tr class="fila_tabla">
						<td><div class= "celda">'.$p['id_pelicula'].'</div></td>
						<td><div class= "celda">'.$p['titulo'].'</div></td>
						<td><div class= "celda">'.$p['genero'].'</div></td>
						<td><div class= "celda">'.$p['director'].'</div></td>
						<td><div class= "celda">'.$p['descripcion_clasificacion'].'</div></td>
						<td><div class= "celda">'.$p['duracion'].' minutos'.'</div></td>
						<td><div class= "celda">'.$p['descripcion_idioma'].'</div></td>
								
						<td><div class= "celda">'.$p['subtitulado'].'</div></td>
								
						<td><div class= "celda_sinopsis">'.$p['descripcion'].'</div></td>
						<td><div class= "celda">
						<a href=https://www.youtube.com/watch?v='.$p['trailer'].' class="btn_trailer">Ver trailer</a>
						<a href=modificarPeliculas.php?idp='.$p['id_pelicula'].' class="btn_modificar">Modificar</a>

						<button name="eliminar" class="btn_eliminar" id='.$p['id_pelicula'].' >Eliminar</button>
									
									</div>
								</td>					
							</tr>';			
					}
						?>
				</table>
			</div>		
			
					
			
		</div> 
		</div>	

</body>
</html>

<script type="text/javascript">
        $('button[name="eliminar"]').click(function(event){
        	var id_enviar = $(this).attr('id');
				var opcion = confirm("¿Esta seguro que desea eliminar esta pelicula? Esto afectará las proyecciones programadas.");
				if (opcion == true){
					var foo = $(event.target).closest("tr");
					foo.remove();
					$.post('listaPeliculas.php', {id_baja: id_enviar}, function () {
						alert ("La pelicula ha sido eliminada.");
					});			
    			}
			});   
</script>
