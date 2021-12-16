<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="../html/style/disenio.css ">
     <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	   
  	<title>Lista de Salas</title>
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


		<!-- Tabla -->
			<div class="col-12 col-lg-10 "> <!-- zona forms y tablas -->
					<table class="table mt-2">
						<tr>
						<th colspan="6" class="titulo-formulario">
							<h4>LISTADO DE SALAS</h4>
						</th>
						</tr>

						<tr>
						<th colspan="6">
							<form class="form_search mt-1 mb-1" action="listaSalas.php" method="POST">
					
						<?php
								echo'
									<select class="input_general" name="sucursal" id="sucursal">
									<option value= "" disabled selected >Buscar por sucursal</option>';
									foreach ($this->sucursales as $suc) {
										echo '<option value="'.$suc['id_sucursal'].'">
										'.$suc['descripcion'].'
										</option>';
									}
								echo'</select>'
						?>
						<input type="submit" name="SetSubmit" value="Buscar">
						<a class="btn btn-primary" href="altaSalas.php" class="">Nueva Sala</a>
					</form>	
						</th>
						</tr>

						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Cantidad de Asientos</th>
							<th>Sucursal</th>
							<th>Direccion</th>										
							<th>Opciones</th>
						</tr>
						<?php
						foreach ($this->salas as $s) 
						{
							echo'<tr class="fila_tabla">
								<td><div class= "celda">'.$s['id_sala'].'</div></td>
								<td><div class= "celda">'.$s['nombre'].'</div></td>
								<td><div class= "celda">'.$s['cant_asientos'].'
								<td><div class= "celda">'.$s['descripcion'].'</div></td>
								<td><div class= "celda">'.$s['direccion'].'</div></td>
								</div></td>
									<td><div class= "celda">
										<button name="eliminar" class="btn_eliminar" id='.$s['id_sala'].' >Deshabilitar</button>
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
				var opcion = confirm("¿Esta seguro que desea deshabilitar esta sala? Esto afectará las proyecciones programadas.");
				if (opcion == true){
					var foo = $(event.target).closest("tr");
					foo.remove();
					$.post('listaSalas.php', {id_baja: id_enviar}, function (data) {
						alert ("La sala n° "+ id_enviar + " ha sido eliminada.");
					});								
    			}
			});      	 		
</script>
