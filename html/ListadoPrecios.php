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

  	<title>Tarifas</title>

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


		<?php
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$date = strftime("%B");
			$date = ucfirst($date);
			$date = strtoupper($date);

		?>		
			


		<div class="col-12 col-lg-10 "> <!-- zona forms y tablas -->			
					<table class="table mt-2">
						<tr>
							<th colspan="10" class="titulo-formulario">
								<h4>VALORES DE ENTRADAS EN <?=$date?></h4>
							</th>
						</tr>
						<tr>
							<th colspan="10">
								<div class="form_search mt-1 mb-1">
				
								</div>
							</th>
						<tr>

						<tr>
							<th>Codigo</th>
							<th>Descripcion</th>
							<th colspan="7" style="text-align: center;">Valores</th>
							<th></th>
						</tr>

						<?php
						foreach ($this->precios as $p){
						?>
							<tr class="fila_tabla">
								<td><div class= "celda"><?=$p['id_precio']?></td></div>
								<td><div class= "celda"><?= $p['descripcion']?></td></div>

								<?php
							echo'
								<td><div class= "celda" id='.$p['id_precio'].'0'.' >Lunes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'1'.'>Martes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'2'.'>Miercoles: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'3'.'>Jueves: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'4'.'>Viernes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'5'.'>Sabado: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'6'.'>Domingo: </div></td>

								<td><div class= "celda" ><a href= modificarPrecios.php?idp='.$p['id_precio'].' class="btn_modificar">Modificar</a>'
							?>
							</tr>				
						<?php } ?>
					</td>
				</table>	
		</div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
   	//Cargar con Ajax

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
		    	for (i in data){
					//alert(JSON.stringify(data));
			   		console.table(data);
			   		var dia = data[i].dia;
			   		var precio = data[i].valor;
			   		var id_selector = <?=$p['id_precio']?> + dia;
			    	$('#' + id_selector).append('$' + precio); 	
		    	}  		    
			})
			.always(function(data) {
		    	//alert( "complete" );
			});  
	    <?php } ?>

   	//Eliminar con Ajax
	$('button[name="eliminar"]').click(function(event){
    	var id_enviar = $(this).attr('id');
    	var opcion = confirm("¿Esta seguro que desea eliminar la tarifa de " +id_enviar+ "?");
		if (opcion == true){
			var foo = $(event.target).closest("tr");
			foo.remove();

	    	$.ajax(
			{
			  url : 'listaPrecios.php',
			  type: "POST",
			  dataType: 'json',
			  data : {id_baja: id_enviar}
			})
			.done(function(data) {
		    	alert("todo OK");
		    	alert ("La tarifa correspondiente '" + id_enviar + "' ha sido eliminada.");
			})
			.fail(function(xhr, textStatus, error){
			      console.log(xhr.statusText);
			      console.log(textStatus);
			      console.log(error);
			})
			.always(function(data) {
		    	alert( "complete" );
			});
		}
	});
});			
</script>