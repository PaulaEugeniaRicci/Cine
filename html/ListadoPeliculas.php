<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	  <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
  	<title>Lista de peliculas</title>
</head>
<body>

	<div class="container_alternative">
		<!-- Barra de navegación principal -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="">
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
			<div class="titulo_formulario"><p>LISTADO DE PELICULAS</p></div>
				<div class="group_search">
					<form class="form_search" action="listaPeliculas.php" method="POST">
						
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
					</form>
					<a class="btn btn-primary" href="altaPeliculas.php" class="">Nueva Pelicula</a>
				</div>



					<table>
						<tr>
							<th>ID</th>
							<th>Titulo</th>
							<th>Genero</th>
							<th>Director</th>
							<th>Clasificacion</th>
							<th>Duracion</th>
							<th>Idioma Original</th>
							<th>Subtitulado</th>
							<th>Descripcion</th>
							<th>Opciones</th>
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
					</form>

					</table>
					
			
		</div>
	</div>


</body>
</html>

<script type="text/javascript">
        $('button[name="eliminar"]').click(function(event){
        	var id_enviar = $(this).attr('id');
				var opcion = confirm("¿Esta seguro que desea eliminar esta pelicula?");
				if (opcion == true){
					var foo = $(event.target).closest("tr");
					foo.remove();
					$.post('listaPeliculas.php', {id_baja: id_enviar}, function () {
						alert ("La pelicula ha sido eliminada.");
					});			
    			}
			});   
</script>
