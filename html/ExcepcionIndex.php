<!doctype html>
<html lang="en">
  <head>
     <!-- Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../html/style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Cinema</title>
  </head>
  <body>
				<!-- Barra de navegación principal -->
				<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navCinema" >
		  		<a class="navbar-brand text-white" href="../controllers/index.php">CINEMA</a>
				</nav>

<!-- Cartelera -->
<div class= "cartelera" > 
			<div class = "cabecera_cartelera d-flex ">
	
				<div class="items_cartelera d-flex align-items-center">
					
					<!-- Formulario de selector de sucursal -->
					<div class="item_cartelera d-flex flex-column justify-content-end">
						
						<form action="index.php" class ="formulario_select_sucursal d-flex"  method="POST" id="sucursal">
							 <select name= "sucursal" id="select_form_sucursal">
								<option value="" disabled selected>Seleccionar sucursal</option>
								<?php foreach ($this->sucursales as $suc) {
								?>		<option value="<?= $suc['id_sucursal'] ?>">Cinema <?= $suc['localidad']?></option>
								<?php } ?>
							</select>			
						</form>

					</div>
					<div class="item_cartelera">
						<button id="btnVerTodo" class="boton_verTodo btn btn-warning pe-auto border-0"> Ver Todo</button>
					</div>
						
				</div>
			</div>

			<!-- Notificacion en vez de posters -->
			<div class="container_form">
						<div class="notificacion">
						  		<div class="mensaje"><p><?=$this->mensaje?></p><a class="btn btn-primary volver" href="<?=$this->enlace?>" class="volver">Volver</a></div>
					</div>	
				</div>	
		</div>


	<!-- Pie de pagina -->	
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
	$(document).ready(function(){
		var id_sucursal;
		var horario;
	    
	    <?php
	        $id = $this->id_sucursal;
	    ?>	        		
	    id_sucursal = <?=$id?>;
	    //console.log(id_sucursal);
	    if (id_sucursal > 0){
	    	$('#select_form_sucursal').val(id_sucursal);
	    }     
	      $('#select_form_sucursal').change(function(){
			this.form.submit();
		});

		$('#btnVerTodo').click(function(){
			$('#select_form_sucursal').val(0);
			$(location).attr('href', 'index.php');
		}); 
	});	
</script>
