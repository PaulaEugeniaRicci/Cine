<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
  	<title>Pelicula</title>
</head>
<body>

		<div class="container_pelicula">
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
	<!-- detalles pelicula -->
					<?php foreach ($this->pelicula as $peli){ ?>
					<div class="titulo_seccion"> <h3 class="titulo_pelicula">Entradas para: <?= $peli['titulo'] ?></h3></div>
					<div class="container_pelicula_pago">	
						<div class="poster"><img src=" data:image;base64, <?= base64_encode($peli['poster']) ?>" ></div>
						
						<div class="detalles">
				  			<p><b>Genero:</b> <?= $peli['genero'] ?> </p>
				  			<p><b>Duración:</b> <?= $peli['duracion'] ?> Minutos </p>
				  			<p><b>Idioma Original:</b> <?= $peli['descripcion_idioma'] ?> </p>
				  			<p><b>Subtitulado:</b> <?= $peli['subtitulado'] ?> </p>
			  			</div>
			  			
			  				<!-- detalle de compra -->

			  			<div class="centro">
				  			<div class="detalle_pedido">
				  				<p>Pelicula: <?= $peli['titulo'] ?> <br>
								Sucursal: <br>
								Sala:<br>
								Asientos:<br>
								Dia y horario:<br>
								Cantidad de entradas:<br>
								Total a abonar:
							</p>
							</div>

							<form action="" class="form_pago" id="form_pago" method="post">
								<input type="hidden" name="id_pelicula" value="<?= $peli['id_pelicula'] ?>">
								<input type="hidden" name="id_sucursal" value="">
								<input type="hidden" name="id_sala" value="">
								<input type="hidden" name="asientos" value="">
								<input type="hidden" name="fecha" value="">
								<input type="hidden" name="horario" value="">
								<div class="columnas_pago">
									<fieldset class="inputs_pago">
										<legend>Información de facturación</legend>
										<label for="nombre">Nombre</label>
										<input class="input_general" type="text" name="nombre" id="nombre" required>
										<label for="apellido">Apellido</label>
										<input class="input_general" type="text" name="apellido" id="apellido" required>
										<label for="direccion">Dirección de facturación</label>
										<input class="input_general" type="text" name="direccion" id="direccion" required>
										<label for="localidad">Localidad</label>
										<input class="input_general" type="text" name="localidad" id="localidad" required>
										<label for="cp">Código postal</label>
										<input class="input_general" type="text" name="cp" id="cp" required>
										<label for="telefono">Teléfono</label>
										<input class="input_general" type="text" name="telefono" id="telefono" required>
									</fieldset>

									<fieldset class="inputs_pago">
										<legend>Método de pago</legend>
										<label for="metodo">Selecciona un método de pago</label>
										<select class="input_general" name="metodo" id="metodo">
											<option value="" selected disabled></option>
											<option value="1">Visa</option>
											<option value="2">Mastercard</option>
										</select>
										<label for="nro_tarjeta">Número de tarjeta</label>
										<input class="input_general" type="text" name="nro_tarjeta" id="nro_tarjeta" required>
										<label for="caducidad">Fecha de caducidad</label>
										<input class="input_general" type="date" name="caducidad" id="caducidad" required>
										<label for="seguridad">Código de seguridad</label>
										<input class="input_general" type="text" name="seguridad" id="seguridad" required>


									</fieldset>

									
								</div>
									<button type="submit" class="btn btn-warning btn_conf_pago">CONFIRMAR PAGO</button>
							</form>
						</div>
					</div>

				<?php } ?>
 	<!-- Pie de pagina-->
			<footer><h1 class="navbar-brand">CINEMA</h1></footer>
		</div>
		<script>
			document.getElementById("form_pago").onsubmit = function(){
				var metodo = document.getElementById('metodo').value;
				var nro_tarjeta = document.getElementById('nro_tarjeta').value;
				var cant_digitos = document.getElementById('nro_tarjeta').value.length;
				var digito = nro_tarjeta.substr(0,1);

				var seguridad = document.getElementById('seguridad').value;
				var cant_digitos_seguridad = document.getElementById('seguridad').value.length;
				

				if(cant_digitos == 16){
					if(cant_digitos_seguridad == 3){
						return true;
					}else{
						alert("El código de seguridad debe tener 3 caracteres");
							return false
					}
				}else{
						alert("La clave de la tarjeta debe tener 16 digitos");
						return false;
					}
				
		}
		</script>
	
	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>



</html>



