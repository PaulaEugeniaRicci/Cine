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

		  	<title>Pelicula</title>
	</head>
	<body>

		<!-- Barra de navegación principal -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navCinema" >
			<a class="navbar-brand" href="../controllers/index.php">CINEMA</a>
		</nav>
		<div class="container_pelicula">
		
		<!-- detalles pelicula -->
		<div class="container-fluid fixContainer">
			<?php foreach ($this->pelicula as $peli){ ?>
			<div class="row titulo_pelicula text-center text-uppercase">
				<div class="col">
					<h3><b><?= $peli['titulo'] ?></b></h3>
				</div>
			</div>

			<div class="row mt-4 mb-4 text-center">
				<div class="col-lg-6">
					<img src=" data:image;base64, <?= base64_encode($peli['poster']) ?>">
				</div>

			<div class="detalles">
				  			<p><b>Genero:</b> <?= $peli['genero'] ?> </p>
				  			<p><b>Duración:</b> <?= $peli['duracion'] ?> Minutos </p>
				  			<p><b>Idioma Original:</b> <?= $peli['descripcion_idioma'] ?> </p>
				  			<p><b>Subtitulado:</b> <?= $peli['subtitulado'] ?> </p>
			</div>
			
			<div class="col-lg-4 mt-4">
				<form class="form_compra" id="form_compra" action="../controllers/pagos.php" method="POST">

				<!-- sucursal -->
					<select class="form-control-sm" id="sucursal" name= "sucursal">
						<option value="" disabled selected>Seleccionar sucursal</option>
							<?php foreach ($this->sucursales as $suc) {
							?>		
							<option value="<?= $suc['id_sucursal'] ?>"> <?= $suc['localidad']?></option>
							<?php } ?>  
					</select>
													
				<!-- fechas  -->
					<h3>Horarios</h3>
					<div class="container_fechas">				
					</div>
										
					<?php	} ?>

				<!-- horarios  -->
					<div class="horarios"></div>

				<!-- precio y cantidad  -->
					<table id="tblTickets">
						<thead>
							<tr>
								<th>Tipo de Tickets</th>
								<th>Cantidad:</th>
								<th>Costo:</th>
								<th>Subtotal:</th>
							</tr>
						</thead>
					</table>
													
					<input type="hidden" name="cant_entradas" id="cant_entradas" value="">	
					<input type="hidden" name="monto_total" id="monto_total" value="">										
					<input type="hidden" name="id_proy" id="id_proy" value="">	
					<button type="submit" id="btnConfirmarCompra" class="btn btn-warning btn-block mb-2 font-weight-bold">CONFIRMAR COMPRA</button>	
				</form>
				<a class="btn btn-outline-primary btn-block" href="index.php" class="">Volver</a>
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
	//Funciones p/mas adelante
		function capitalizeFirstLetter(string) {
  			return string.charAt(0).toUpperCase() + string.slice(1);
		}

		function prepararFechas(string){

			var fecha = string;
			//Separo el horario en FECHA y HORA
			var fecha_separada = fecha.split(" ");
		   	//console.log("Soy la primera fecha sin hora "+ fecha_separada[0]);

		   	//Separo la FECHA, SIN " / "
		   	var dateString = fecha_separada[0]; 
			var dateParts = dateString.split("/");
			//console.log("Soy la fecha separada en dia/mes/anio: " + dateParts);

			//Creo objeto tipo Date con la FECHA
			const date = new Date (dateParts[2], dateParts[1]-1, dateParts[0]); //ANIO- MES (indexado- arranca en 0, no 1)-DIA

			//Obtengo los strings y capitalizo la primer letra
			const mes = date.toLocaleString('default', {month: 'long'});
			const dia = date.toLocaleString('default', {weekday: 'long'});
			var Mes = capitalizeFirstLetter(mes);
			var Dia = capitalizeFirstLetter(dia);

			//Retorno mes y dia, en string y en int
			return [Dia, Mes, dateParts[0], dateParts[1]];
		}

		function appendLabel(dia_mes){
			var nombre_label = dia_mes[2] + "-" + dia_mes[3];		
				
			$( ".container_fechas" ).append('<input type="radio" class="radio" id="'+nombre_label+'" autocomplete="off" >');
			$(".container_fechas").append('<label for="'+nombre_label+'" class="lbl-fecha"> </label> ');

			var label = $("label[for="+nombre_label+"]");
			label.append($('<span class="dia">').text(dia_mes[0]));
			label.append($('<span>').text(dia_mes[1]));
			label.append($('<span>').text(dia_mes[2]));	
		}

		function appendLabelHorarios(array){
			var id_radio = array['id_proyeccion'];
			var hora = array['horario'];
			//console.log("Soy el nuevo id de este radio: " + id_radio);		
			
			$( ".horarios" ).append('<input type="radio" class="btn-check radio" name="options" id="'+id_radio+'" autocomplete="off" >');
			$(".horarios").append('<label for="'+id_radio+'" class="lbl-horario"> </label> ');
			var label_horario = $("label[for="+id_radio+"]");
			label_horario.append().text(hora);
				
		}
	
		function appendEntradas(filas){
			$( "#tblTickets" ).show(900);
			$( "#tblTickets" ).append("<tbody id='ultimoPaso'></tbody>");

			var cant_asientos = filas[0]['cant_asientos'] - filas[0]['entradas'];
			

			for (i in filas){
				var descripcion = filas[i]['descripcion'];
				var costo = filas[i]['valor'];
				var id_select = descripcion+i;

				$( "#ultimoPaso" ).append('<tr><td>'+descripcion+'</td>	<td><select class="cantidad_entradas" id="'+id_select+'"> </select></td>	<td class="costo">$'+costo+'</td><td class="subtotal">$0</td> </tr>');
				
				
				for (j=0; j<=cant_asientos; j++){
					$( '#'+id_select).append('<option class="asientos" value='+j+'>'+j+'</option>');
				}
				
			}
		}

		function AjaxRequestFecha(id_pelicula, id_sucursal){
			 $.ajax(
				{
				  url : 'entradas.php',
				  type: "POST",
				  dataType: 'json',
				  data : {peli: id_pelicula, suc: id_sucursal}
				})
				.done(function(data) { 
				   	for (i in data){
				   		//console.log(data[i]); //fecha: "12/07/2021 16:13"
				   		//console.log(data[i]["fecha"]); // 12/07/2021 16:13
				   		var dia_mes = prepararFechas (data[i]["fecha"]);
				   		//console.log("Soy la fecha numero: "+i+ " y tengo el dia: "+dia_mes[0]+ " con el mes: " +dia_mes[1]);
				   		appendLabel (dia_mes);
				   	}
				})
				.always(function(data) {
				    //alert( "complete" );
				});
		}

		function AjaxRequestHorario(id_pelicula, id_sucursal, fecha){
			 $.ajax(
				{
				  url : 'entradas.php',
				  type: "POST",
				  dataType: 'json',
				  data : {peliFecha: id_pelicula, sucFecha: id_sucursal, fecha: fecha}
				})
				.done(function(data) { 			   	
				   	for (i in data){
				   		//alert(JSON.stringify(data[i]));
				   		appendLabelHorarios(data[i]);
				   	}					   		
				})
				.always(function(data) {
				    //alert( "complete" );
				});
		}

		function AjaxRequestEntradaSala(id_proyeccion){
			 $.ajax(
				{
				  url : 'entradas.php',
				  type: "POST",
				  dataType: 'json',
				  data : {id_proyeccion: id_proyeccion}
				})
				.done(function(data) { 			   	
				   	alert(JSON.stringify(data));
				   	appendEntradas(data);			   		
				})
				.always(function(data) {
				    //alert( "complete" );
				});
		}



	//Preparacion del documento y adicion de eventos
	$(document).ready(function(){

		//Deshabilitar boton de submit
		$("#btnConfirmarCompra").hide();

		//Establecer primero como hidden la tabla de entradas
		$( "#tblTickets" ).hide();

		//Cargar select sucursal
		var id_sucursal;
		var id_pelicula;
	    
	    <?php
	        $id = $this->id_sucursal;
	        foreach ($this->pelicula as $peli){   
	    ?>	        		
	    id_pelicula = <?=$peli['id_pelicula']?>;
		
		<?php } ?>
		
		id_sucursal = <?=$id?> ;
	    if (id_sucursal>0){
	    	$('#sucursal').val(id_sucursal);

	    	 //Cargar fechas si ya esta seleccionada la sucursal al ingresar
	   		AjaxRequestFecha (id_pelicula, id_sucursal);	
	    }

	    //Agregar evento onchange para el select
	    $('#sucursal').change(function() {
  			//vacio el div para no pisar lo que ya estaba
  			$(".container_fechas").empty();
  			$(".horarios").empty();
  			id_sucursal = $('#sucursal').val();

  			//vacio la tabla de precios-entradas
  			$( "#tblTickets" ).hide();
  			$('#tblTickets tbody > tr').remove();
  			//vuelvo a hacer peticion de datos y renderizo fechas
  			AjaxRequestFecha (id_pelicula, id_sucursal);
		});

	    //Agregar evento para renderizar horarios al hacer click en fecha

	    $(".container_fechas").on('click', '> *', function(event) {
	    	
	    	$(".horarios").empty();
	    	$( "#tblTickets" ).hide();
  			$('#tblTickets tbody > tr').remove();
	    	
	    	var moo = $(this).attr('id');
	    	if (typeof moo != 'undefined') {
        		event.stopPropagation();
       			AjaxRequestHorario(id_pelicula, id_sucursal, moo);
			}
	    });
	    //Cargar cantidad: tipo de entrada, cantidad disponible depende de la SALA
	    $(".horarios").on('click', '> *', function(event) {
	    	var id_proy = $(this).attr('id');
	    	$( "#tblTickets" ).hide();
  			$('#tblTickets tbody > tr').remove();
	    	
	    	if (typeof id_proy != 'undefined') {
        		event.stopPropagation();
       			alert ("me clickeaste!");
       			$('#id_proy').val(id_proy);
       			AjaxRequestEntradaSala(id_proy);
			}	
	    });
	  	
	  	//The event.stopPropagation() method stops the bubbling of an event to parent elements, preventing any parent event handlers from being executed. (!!)
	  	var flag = 0;
	  	
	  	$("#tblTickets").on("change", "select", function(event){
   			var id= $(this).attr('id');
   			var cantidad = $(this).val();
   			event.stopPropagation();
   			var numero = parseInt(id.replace(/[^0-9.]/g, ""));

   			var costo= $("#tblTickets").find('td.costo').eq(numero).text();
   			var costo1= costo.replace(/[^0-9.]/g, "");
   			var monto = cantidad * costo1;

   			$("#tblTickets").find('td.subtotal').eq(numero).text('$'+monto);

   			
			$(".cantidad_entradas").each(function() {
				var select = $(this).val();
				if (select > 0){
					flag = 1;
				}
			});
			if (flag==1){ $("#btnConfirmarCompra").show(900); }
			if (flag==0){ $("#btnConfirmarCompra").hide(900); }
			flag = 0;
   			
 		});
	  	
	  	$("form").submit(function(){
  			var acumulador = 0;
  			var total = 0;
  			$(".cantidad_entradas").each(function() {
				var cant_select = parseInt($(this).val());
				acumulador = acumulador + cant_select;
				//alert( acumulador);
			});
			$('td.subtotal').each(function(){
				var subtotal_texto = $(this).text();
				var subtotal= parseFloat(subtotal_texto.replace(/[^0-9.]/g, ""));
				total = total + subtotal;
			});
			$("#cant_entradas").val(acumulador);
			$("#monto_total").val(total);


		});

	});
</script>



