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
  	<title>Modificar pelicula</title>
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
				<div class="titulo-formulario p-2 mt-2 text-center"><h4>MODIFICAR PELICULA</h4></div>
				<form class="formulario" action="" method="POST" enctype="multipart/form-data">
					<div class="bloque_form_columns">
						<div class="form_column1">				
					<?php foreach ($this->peliculas as $p){ ?>
						<label for="titulo">Titulo</label>
						<input class="input_general" type="text" name="titulo" value="<?= $p['titulo']?>" required>				
						<label for = "director">Director</label>
						<input  class="input_general" type="text" name="director" value="<?= $p['director']?>" required></td>
						
						<label for="clasificacion">Clasificación</label>
								<?php
									echo'
										<select class="input_general" name="clasificacion" id="clasificacion" required>';
										foreach ($this->clasificaciones as $c) {
											echo '<option value="'.$c['id_clasificacion'].'">
											'.$c['descripcion_clasificacion'].'
											</option>';
										}
									echo'</select>'
								?>
								
						<label for="duracion">Duración</label>
						<input  class="input_general" type="number" name="duracion" min="20" max="240" value="<?= $p['duracion']?>">

						</div>
						<div class="form_column2">	
						<label  for="idioma">Idioma</label>
								<?php
									echo'
										<select class="input_general" name="idioma" id="idioma"> <option value="" disabled selected></option>';
										foreach ($this->idiomas as $i) {
											echo '<option value="'.$i['id_idioma'].'">
											'.$i['descripcion_idioma'].'
											</option>';
										}
									echo'</select>'
								?>

						<label for="Subtitulos">Subtitulos</label>
						<select class="input_general" name="subtitulado" id="subtitulos">
							<option value="" disabled selected></option>
							<option value="Doblado">Doblado</option>
							<option value="Subtitulado">Subtitulado</option>
						</select>
							
						<label for="sinopsis">Sinopsis</label>
						<textarea class="input_general" name="sinopsis" required><?=$p['descripcion']?></textarea>

						<label for="fecha">Fecha de estreno</label>
						<input class="input_general" type="date" name="fecha" value="<?= $p['estreno']?>" required>

						</div>
						<div class="form_column3">	
						<label for="genero">Genero</label>
						<div class="group_checkbox" id="genero">
							<div class="group_checkbox_column1">
								<div><input class="input_check" type="checkbox" name="genero[]" value="5" id="accion">
								<label for="accion">Acción</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="6" id="animacion">
								<label for="animacion">Animación</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="2" id="comedia">
								<label for="comedia">Comedia</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="4" id="crimen">
								<label for="crimen">Crimen</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="10" id="documental">
								<label for=documental>Documental</label></div>
							</div>
							<div class="group_checkbox_column2">
								
								<div><input class="input_check" type="checkbox" name="genero[]" value="1" id="drama">
								<label for="drama">Drama</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="9" id="romance">
								<label for="romance">Romance</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="7" id="terror">
								<label for="terror">Terror</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="3" id="thriller">
								<label for="thriller">Thriller</label></div>
								<div><input class="input_check" type="checkbox" name="genero[]" value="8" id="western">	
								<label for="western">Western</label></div>	
							</div>
						</div>

						<label for="trailer">Trailer</label>
						<input class="input_general" type="text" name="trailer" id="trailer" value="<?= $p['trailer']?>" required>

						<label for="poster">Poster</label>
						<input  class="input_general" type="file" name="poster">


						</div>
					</div>
					<?php } ?>
					<div class="form_botones">
					<input type="submit" name="setSubmit" value="Guardar" class="submit btn btn-primary">
					<a class="btn btn-outline-secondary volver" href="listaPeliculas.php" class="">Volver</a>
				</div>
				</form>
				
			</div>
			
		
		</div>
</body>
</html>


<script type="text/javascript">
 $(document).ready(function(){
	var arrayPeli = [];
	    <?php
	        foreach ($this->peliculas as $p){
	    ?>	        		
	        arrayPeli.push("<?=$p['id_clasificacion']?>");
	        arrayPeli.push("<?=$p['id_idioma']?>");
	        arrayPeli.push("<?=$p['subtitulado']?>");
	        arrayPeli.push("<?=$p['id_pelicula']?>");       
	    <?php } ?>

	$('#clasificacion').val(arrayPeli[0]);
	$('#idioma').val(arrayPeli[1]);
	$('#subtitulos').val(arrayPeli[2]);	

	var id = arrayPeli[3];

	$.ajax(
		{
		  url : 'modificarPeliculas.php',
		  type: "POST",
		  dataType: 'json',
		  data : {"id_enviar": id}
		})
		.done(function(data) {
			//alert(JSON.stringify(data));
		   	//console.table(data);	    
		    for (i in data){
		    	var foo = parseInt(data[i].id_genero);
		    	$("[name='genero[]'][value=" + foo + "]").prop('checked', true);
		    }
		})
		.fail(function(data) {
		    //alert( "error" );
		})
		.always(function(data) {
		    //alert( "complete" );
		});


});	

</script>