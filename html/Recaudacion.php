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
  	<title>Recaudacion</title>
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
						<th colspan="8" class="titulo-formulario">
							<h4>RECAUDACIÓN SUCURSAL <?=$this->sucursalDetalle?></h4>
						</th>
						</tr>

						<tr>
						<th colspan="8">
							<form class="form_search mt-1 mb-1" action="recaudacion.php" method="POST">
					
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
						</th>
						</tr>
						

						<tr>
							<th>MES</th>
							<th>VENTAS</th>
							<th>CRECIMIENTO</th>
							<th>% FRENTE A MES ANTERIOR</th>
						</tr>

						<?php
						$mesAnterior = $acumVentas = $acumPorcentaje = $acumCrecimiento = 0;
						foreach ($this->resumen as $r) 
						{
							$crecimiento = 	(int)$r['monto'] - $mesAnterior;
							$porcentaje = ($crecimiento*100 )/ $r['monto'];
							echo'<tr class="fila_tabla">

									<td><div class= "celda">'.$r['fecha'].'</div></td>
									<td><div class= "celda">'.'$'.$r['monto'].'</div></td>
									<td><div class= "celda">'.'$'.$crecimiento.'</div></td>
									<td><div class= "celda">'.$porcentaje.'%'.'</div></td>
													
								</tr>';	
							$mesAnterior = $r['monto'];

							$acumVentas +=  $mesAnterior;
							$acumCrecimiento += $crecimiento;
							$acumPorcentaje += $porcentaje; 
							
						}
						echo'<tr class="fila_tabla">

									<td><div class= "celda">TOTAL</div></td>
									<td><div class= "celda">'.'$'.$acumVentas.'</div></td>
									<td><div class= "celda">'.'$'.$acumCrecimiento.'</div></td>
									<td><div class= "celda">'.$acumPorcentaje.'%'.'</div></td>
							</tr>';	
						?>
					</table>
				</div>	
			</div> 
		</div>	
	</body>
</html>
