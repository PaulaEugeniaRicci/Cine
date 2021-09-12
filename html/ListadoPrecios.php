<!DOCTYPE html>
<html lang="es">
<head>
	 <!-- Bootstrap CSS -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/disenio.css ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik Mono One">
     <script src="https://kit.fontawesome.com/187a5bbb1c.js" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  	<title>Tarifas</title>

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


		<?php
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$date = strftime("%B");
			$date = ucfirst($date);
			$date = strtoupper($date);

		?>		
			

		<!-- Tabla -->
		<div class="container_form">
			<div class="titulo_formulario"><p>VALORES DE ENTRADAS EN <?=$date?></p></div>
			<div class="group_search">
				
				<a class="btn btn-primary" href="altaPrecios.php" class="">Nueva tarifa</a>
			</div>
					<table>
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
								<td><?=$p['id_precio']?></td>
								<td><?= $p['descripcion']?></td>

								<?php
							echo'
								<td><div class= "celda" id='.$p['id_precio'].'0'.' >Lunes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'1'.'>Martes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'2'.'>Miercoles: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'3'.'>Jueves: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'4'.'>Viernes: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'5'.'>Sabado: </div></td>
								<td><div class= "celda" id='.$p['id_precio'].'6'.'>Domingo: </div></td>

								<td><a href= modificarPrecios.php?idp='.$p['id_precio'].' class="btn_modificar">Modificar</a>'
							?>

								<button name="eliminar" class="btn_eliminar" id="<?=$p['id_precio']?>" >Eliminar</button> </td>
									
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