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
  	<title>Modificar tarifa</title>
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
  			<div class="titulo_formulario"><p>MODIFICAR PRECIOS</p></div>
			<form class="formulario" action="" method="POST">		
				<div class="bloque_form_columns">
					<div class="form_column1">	
					<?php foreach ($this->precios as $p){ ?>
						<label for="descripcion">Descripcion</label>
						<input type="text" name="descripcion" value="<?= $p['descripcion']?>" required>
						
						</div>
						<div class="form_column2">	
						<p>Tarifas</p>

						<?php
							echo'
							<label for="lunes">Lunes</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'0'.' value="" required>

							<label for="martes">Martes</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'1'.' value="" required>

							<label for="miercoles">Miercoles</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'2'.' value="" required>

							<label for="jueves">Jueves</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'3'.' value="" required>

							<label for="viernes">Viernes</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'4'.' value="" required>

							<label for="sabado">Sabado</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'5'.' value="" required>	

							<label for="domingo">Domingo</label>
							<input class="input_general" type="number" min="0.00" max="1000" step="0.01" name="dias[]" id='.$p['id_precio'].'6'.' value="" required>'
							?>
						
				<?php } ?>

				</div>
			</div>
				<div class="form_botones">
				<input type="submit" name="setSubmit" value="Guardar" class="submit btn btn-primary">
				<a class="btn btn-secondary volver" href="listaPrecios.php" class="volver">Volver</a>
			</div>
			</form>
		
		</div>
			
		
	
		</div>
	</body>
</html>

<script type="text/javascript">
        $(document).ready(function(){
        	//Aparejar informacion
	        var descripcion;
	        var id;

	        <?php
	        	foreach ($this->precios as $p){
	        		?>	        		

	        		var descripcion = "<?=$p['descripcion']?>";
	         		var id = "<?=$p['id_precio']?>";
	       

			        $.ajax(
					{
					  url: 'listaPrecios.php',
					  type: "POST",
					  dataType: 'json',
					  data : {descripcion_enviar: descripcion}

					})
					.done(function(data) {
				    	console.table(data);
				    	for (i in data){
					   		var dia = data[i].dia;
					   		var precio = data[i].valor;
					   		var id_selector = <?=$p['id_precio']?> + dia;
					    	$('#' + id_selector).val(precio); 	
				    	} 		    
					})
					.always(function(data) {
				    	//alert( "complete" );
					});

	        <?php } ?>
	       
        })
</script>
