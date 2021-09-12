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
  	<title>Lista de empleados</title>
</head>
<body>

	<div class="container_alternative">
	<!-- Barra de navegación principal -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark" ">
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
			<div class="titulo_formulario"><p>LISTADO DE EMPLEADOS </p></div>
				<div class="group_search">
					<form class="form_search" action="listaEmpleados.php" method="POST">
						
						<input type="text" name="valor" class="txtSize input_general" placeholder="Buscar por CUIL/Apellido" size="20" maxlength="20">
					
						<?php
								echo'
									<select class="input_general" name="sucursal" id="sucursal">
									<option value= "" disabled selected >Buscar por sucursal</option>';
									foreach ($this->sucursales as $s) {
										echo '<option value="'.$s['id_sucursal'].'">
										'.$s['descripcion'].'
										</option>';
									}
								echo'</select>'
						?>
						<input type="submit" name="SetSubmit" value="Buscar">

					</form>
					<a class="btn btn-primary" href="altaEmpleados.php" class="">Nuevo Empleado</a>
					</div>


					<table>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>CUIL</th>
							<th>Direccion</th>
							<th>Telefono</th>
							<th>Sucursal</th>
							<th>Opciones</th>
						</tr>
						<?php
						foreach ($this->empleados as $e) 
						{
							echo'<tr class="fila_tabla">
									<td><div class= "celda">'.$e['id_empleado'].'</div>
</td>
									<td><div class= "celda">'.$e['nombre'].'</div>
</td>
									<td><div class= "celda">'.$e['apellido'].'</div>
</td>
									<td><div class= "celda">'.$e['cuil'].'</div>
</td>
									<td><div class= "celda">'.$e['direccion'].'</div>
</td>
									<td><div class= "celda">'.$e['telefono'].'</div>
</td>
									<td><div class= "celda">'.$e['descripcion'].'</div>
</td>
									<td><div class= "celda">
										<a href=modificarEmpleados.php?ide='.$e['id_empleado'].' class="btn_modificar">Modificar</a>

										<button name="eliminar" class="btn_eliminar" id='.$e['id_empleado'].' >Eliminar</button>
									</div>
</td>					
								</tr>';			
						}
						?>
					</table>
					
				
			
		</div>

			
	</div>


</body>
</html>


<script type="text/javascript">
        $('button[name="eliminar"]').click(function(event){
        	var id_enviar = $(this).attr('id');
				var opcion = confirm("¿Esta seguro que desea eliminar este empleado?");
				if (opcion == true){
					var foo = $(event.target).closest("tr");
					foo.remove();
					$.post('listaEmpleados.php', {id_baja: id_enviar}, function () {
						alert ("El empleado ha sido eliminado.");
					});			
    			}
			});      	 		
</script>
