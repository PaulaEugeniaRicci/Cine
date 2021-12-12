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
					<div class="titulo_pelicula"> <h3><?= $peli['titulo'] ?></h3></div>
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
				  				<ul style="list-style-type:none;">
								    <li>Pelicula: <?= $peli['titulo'] ?></li>
								    <li>Sucursal: <?= $this->sucursal ?></li>
								    <li>Sala: <?= $peli['nombre'] ?></li>
								    <li>Dia y horario: <?= $peli['fecha']?>hs. </li>
								    <li>Cantidad de entradas:  <?= $this->cant_entradas ?></li>
								    <li>Total a abonar: $<?= $this->monto ?></li>
								</ul>
							</div>

							<form action="" class="form_pago" id="form_pago" method="post">
	
								<div class="columnas_pago">
									<fieldset class="inputs_pago">
										<legend>Información de facturación</legend>
										<label for="nombre">Nombre</label>
										<input class="input_general" type="text" name="nombre" id="nombre" required>
										<label for="apellido">Apellido</label>
										<input class="input_general" type="text" name="apellido" id="apellido" required>
										<label for="dni">DNI</label>
										<input class="input_general" type="text" name="dni" id="dni" required>
										<label for="telefono">Telefono</label>
										<input class="input_general" type="text" name="telefono" id="telefono" required>
										<label for="email">EMAIL</label>
										<input class="input_general" type="text" name="email" id="email" required>

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
									<input type="hidden" name="id_proy" id="id_proy" value="<?= $peli['id_proyeccion'] ?>">	
									<input type="hidden" name="sucursal" id="sucursal" value="<?= $peli['id_sucursal'] ?>">	
									<input type="hidden" name="cant_entradas" id="entradas" value="<?= $this->cant_entradas ?>">	
									<input type="hidden" name="monto_total" id="monto" value="<?= $this->monto ?>">
									
									<button type="submit" class="btn btn-warning btn_conf_pago">CONFIRMAR PAGO</button>
							</form>

							<a class="btn btn-primary" href="entradas.php?id_pelicula=<?=$peli['id_pelicula'] ?>&id_sucursal=<?=$peli['id_sucursal'] ?>" class="">Volver</a>
						</div>
					</div>

				<?php } ?>
 	<!-- Pie de pagina-->
			<footer><div class="creditos">
		<h5>CINEMA</h5>
		
		</div>
			<div class="footer_login">
				<a href="../controllers/listaPeliculas.php"><img src="../img/login.png" title="Acceso de personal"></a>
			</div></footer>
		</div>
</body>
</html>

<script type="text/javascript">
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

