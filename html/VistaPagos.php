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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<title>Pelicula</title>
</head>
<body>

	<!-- Barra de navegación principal -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navCinema" >
		<a class="navbar-brand" href="../controllers/index.php">CINEMA</a>
	</nav>

	<!-- detalles pelicula -->
	<div class="container-fluid fixContainer">
		<?php foreach ($this->pelicula as $peli){ ?>
		<div class="row titulo_pelicula text-center text-uppercase">
			<div class="col">
				<h3><b><?= $peli['titulo'] ?></b></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-3 ">
				<div class="row">
					<div class="col-12">
						<div class="poster text-center"><img src=" data:image;base64, <?= base64_encode($peli['poster']) ?>" ></div>
					</div>
					<div class="col-12">
						<div class="detalles d-none d-lg-block text-center mt-4">
				  			<p><b>Genero:</b> <?= $peli['genero'] ?> </p>
				  			<p><b>Duración:</b> <?= $peli['duracion'] ?> Minutos </p>
				  			<p><b>Idioma Original:</b> <?= $peli['descripcion_idioma'] ?> </p>
				  			<p><b>Subtitulado:</b> <?= $peli['subtitulado'] ?> </p>
			  		</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-9">
				<div class="row">
					<div class="col-12">
						<div class="detalle_pedido">

							<!-- detalle de compra -->
				  				<ul style="list-style-type:none;">
								    <li>Pelicula: <?= $peli['titulo'] ?></li>
								    <li>Sucursal: <?= $this->sucursal ?></li>
								    <li>Sala: <?= $peli['nombre'] ?></li>
								    <li>Dia y horario: <?= $peli['fecha']?>hs. </li>
								    <li>Cantidad de entradas:  <?= $this->cant_entradas ?></li>
								    <li>Total a abonar: $<?= $this->monto ?></li>
								</ul>
							</div>
</div>
					<div class="col-12 mb-4">
						<div class=" row ">
							<div class="col-12 col-lg-6">
								<form action="" class="form_pago" id="form_pago" method="post">
									<fieldset class="inputs_pago mb-4">
										<legend>Información de facturación</legend>
										<label for="nombre">Nombre</label>
										<input class="input_pago" type="text" name="nombre" id="nombre" required data-toggle="tooltip" data-placement="top" title="Ingrese su nombre">
										<label for="apellido">Apellido</label>
										<input class="input_pago" type="text" name="apellido" id="apellido" required>
										<label for="dni">DNI</label>
										<input class="input_pago" type="text" name="dni" id="dni" required>
										<label for="telefono">Telefono</label>
										<input class="input_pago" type="text" name="telefono" id="telefono" required>
										<label for="email">EMAIL</label>
										<input class="input_pago" type="text" name="email" id="email" required>
									</fieldset>
								</div>
								<div class="col-12 col-lg-6">
									<fieldset class="inputs_pago mb-4">
										<legend>Método de pago</legend>
										<label for="metodo">Selecciona un método de pago</label>
										<select class="input_pago" name="metodo" id="metodo">
											<option value="" selected disabled></option>
											<option value="1">Visa</option>
											<option value="2">Mastercard</option>
										</select>
										<label for="nro_tarjeta">Número de tarjeta</label>
										<input class="input_pago" type="text" name="nro_tarjeta" id="nro_tarjeta" required>
										<label for="caducidad">Fecha de caducidad</label>
										<input class="input_pago" type="date" name="caducidad" id="caducidad" required>
										<label for="seguridad">Código de seguridad</label>
										<input class="input_pago" type="text" name="seguridad" id="seguridad" required>
									</fieldset>
								</div>	
									<input type="hidden" name="id_proy" id="id_proy" value="<?= $peli['id_proyeccion'] ?>">	
									<input type="hidden" name="sucursal" id="sucursal" value="<?= $peli['id_sucursal'] ?>">	
									<input type="hidden" name="cant_entradas" id="entradas" value="<?= $this->cant_entradas ?>">	
									<input type="hidden" name="monto_total" id="monto" value="<?= $this->monto ?>">
									
							</div>			
						</div>
					</div>
					<div class="col-12">
						<div class="row mt-4 mb-4">
							<div class="col-12 col-lg-3 offset-lg-3">
								<button type="submit" class="btn btn-warning btn-block mb-2 font-weight-bold">CONFIRMAR PAGO</button>
							</div>
							<div class="col-12 col-lg-3">
								<a class="btn btn-outline-primary btn-block " href="entradas.php?id_pelicula=<?=$peli['id_pelicula'] ?>&id_sucursal=<?=$peli['id_sucursal'] ?>" class="">Volver</a>
							</div>
						</div>
					</div>	
					</form>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
 	<!-- Pie de pagina-->
		<footer class="container-fluid">
		<div class="row pt-4">
			<div class="col">
				<h5>CINEMA</h5>
				<ul>
					<li>Paula Ricci</li>
					<li>Marco Romero</li>
				</ul>
			</div>
			<div class="col text-right">		
					<a href="../controllers/listaPeliculas.php"><img src="../html/img/login.png" title="Acceso de personal"></a>
			</div>
		</div>
	</footer>
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

