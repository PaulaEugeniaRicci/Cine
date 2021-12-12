<?php

	// ../models/Proyecciones.php

	class Proyecciones extends Model {
		
		
		//Metodos para parte Cliente

		//RETORNAR INFORMACION DE UNICA PELICULA-GENERO segun ID proyeccion
		public function getPeliProyeccion($id_proyeccion){
			
			if(!ctype_digit($id_proyeccion)) throw new ExcepcionProyeccion("Error en el ID de la proyeccion.");

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, p.poster, p.trailer, s.nombre, s.id_sucursal, proy.id_proyeccion, DATE_FORMAT(proy.horario, '%d/%m %H:%i') as fecha, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				JOIN proyecciones proy ON p.id_pelicula = proy.id_pelicula 
				JOIN salas s ON proy.id_sala = s.id_sala
				WHERE proy.id_proyeccion = $id_proyeccion
				 ");

			return $this->db->fetchAll();
		}

		//RETORNAR PELICULAS Y PROYECCIONES
		public function getPelisProyecciones(){
			$this->db->query("SELECT proy.id_proyeccion, proy.id_pelicula, DATE_FORMAT(proy.horario, '%d/%m/%Y %H:%i') as fecha, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, p.trailer, p.poster
				FROM proyecciones proy
				INNER JOIN peliculas p ON p.id_pelicula = proy.id_pelicula
				WHERE proy.horario > CURDATE()
				GROUP BY p.id_pelicula");

			if($this->db->numRows()<1) throw new ExcepcionProyeccion("No hay funciones disponibles.");
			
			return $this->db->fetchAll();
		}
		//RETORNAR PELICULAS EN PROYECCION POR SUCURSAL
		public function getPelisProyeccionesSucursal($id){
			$this->db->query("SELECT proy.id_proyeccion, proy.id_pelicula, DATE_FORMAT(proy.horario, '%d/%m/%Y %H:%i') as fecha, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, p.trailer, p.poster
				FROM proyecciones proy
				INNER JOIN salas s ON proy.id_sala = s.id_sala
				INNER JOIN peliculas p ON p.id_pelicula = proy.id_pelicula
				WHERE s.id_sucursal = $id AND
				proy.horario > CURDATE()
				GROUP BY p.id_pelicula;");

			if($this->db->numRows()<1) throw new ExcepcionProyeccion("No hay funciones disponibles en esa sucursal.");

			return $this->db->fetchAll();
		}
		//RETORNAR SUCURSALES DONDE SE PROYECTA ESA PELICULA
		public function getSucursalbyPelicula($id){
			$this->db->query("SELECT proy.id_proyeccion, proy.id_pelicula, suc.id_sucursal, suc.localidad, suc.direccion

				FROM proyecciones proy
				INNER JOIN salas s ON proy.id_sala = s.id_sala
				INNER JOIN sucursales suc ON s.id_sucursal = suc.id_sucursal
				WHERE proy.id_pelicula = $id AND
				proy.horario > CURDATE()
				GROUP BY suc.id_sucursal");

			if($this->db->numRows()<1) throw new ExcepcionProyeccion("No hay funciones disponibles en esa sucursal.");

			return $this->db->fetchAll();
		}
		//RETORNAR FECHAS DE PROYECCION
		public function getFechasSinHora($id_sucursal, $id_pelicula){
			$this->db->query("SELECT DATE_FORMAT(p.horario, '%d/%m/%Y') as fecha FROM proyecciones p
				INNER JOIN salas s ON p.id_sala = s.id_sala
				WHERE p.id_pelicula = $id_pelicula AND
				s.id_sucursal = $id_sucursal AND
				p.horario > CURDATE()
				GROUP BY fecha
				LIMIT 7");

			if($this->db->numRows()<1) throw new ExcepcionProyeccion("Error: no se pudo encontrar la fecha solicitada.");
			return $this->db->fetchAll();
		}

		public function getHorasSinFecha($id_sucursal, $id_pelicula, $fecha){
			$date = time();
			$anio = date('Y', $date);

			$fecha = explode("-", $fecha);
			$fechaComparar = new DateTime("$anio"."-"."$fecha[1]"."-"."$fecha[0]");
			$fechaComparar = $fechaComparar->format('d/m/Y');

			$this->db->query("SELECT p.id_proyeccion, DATE_FORMAT(p.horario, '%H:%i') as horario FROM proyecciones p
				INNER JOIN salas s ON p.id_sala = s.id_sala
				WHERE p.id_pelicula = $id_pelicula AND
				s.id_sucursal = $id_sucursal AND
				DATE_FORMAT(p.horario, '%d/%m/%Y') like '$fechaComparar'
				LIMIT 7");

			if($this->db->numRows()<1) throw new ExcepcionProyeccion("Error: no se pudo encontrar la fecha solicitada.");
			return $this->db->fetchAll();
		}

		public function getTarifaSala($id_proyeccion){
			$this->db->query("SELECT p.descripcion, p.valor, s.cant_asientos, COUNT(e.id_proyeccion) AS 'entradas' FROM precios p
				INNER JOIN preciosdeproyecciones pp ON p.id_precio = pp.id_precio
				INNER JOIN proyecciones proy ON proy.id_proyeccion = pp.id_proyeccion
				LEFT JOIN entradas e ON e.id_proyeccion = proy.id_proyeccion
				INNER JOIN salas s ON s.id_sala = proy.id_sala
				WHERE pp.id_proyeccion = $id_proyeccion");
			return $this->db->fetchAll();
		}



		//Metodos para parte Administrador

		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT p.id_proyeccion, p.id_pelicula, p.id_sala, DATE_FORMAT(p.horario, '%d/%m/%Y %H:%i') as fecha, pp.titulo, pp.duracion, s.nombre, s.id_sala, suc.descripcion
				FROM proyecciones p
				LEFT JOIN peliculas pp on p.id_pelicula = pp.id_pelicula
				LEFT JOIN salas s on p.id_sala = s.id_sala
				LEFT JOIN sucursales suc on s.id_sucursal = suc.id_sucursal
				ORDER BY pp.titulo");
			return $this->db->fetchAll();
		}

		//RETORNA POR FECHA
		public function getProyeccionesByFecha($selec){

			if ($selec == 1){
				$fecha = new DateTime();
				$fecha = $fecha->format('d/m/Y');

				$this->db->query("SELECT p.id_proyeccion, p.id_pelicula, p.id_sala, DATE_FORMAT(p.horario, '%d/%m/%Y %H:%i') as fecha, pp.titulo, pp.duracion, s.nombre, s.id_sala, suc.descripcion
					FROM proyecciones p
					LEFT JOIN peliculas pp on p.id_pelicula = pp.id_pelicula
					LEFT JOIN salas s on p.id_sala = s.id_sala
					LEFT JOIN sucursales suc on s.id_sucursal = suc.id_sucursal
					WHERE DATE_FORMAT(p.horario, '%d/%m/%Y') like '$fecha'
					ORDER BY pp.titulo");
				return $this->db->fetchAll();
		}

			if (($selec == 2)) {
				$selec = time();
				$mes = date('n', $selec);
				$anio = date('Y', $selec);
				$fechas = $this->getDiasSemana();			

				$this->db->query("SELECT p.id_proyeccion, p.id_pelicula, p.id_sala, DATE_FORMAT(p.horario, '%d/%m/%Y %H:%i') as fecha, pp.titulo, pp.duracion, s.nombre, s.id_sala, suc.descripcion
					FROM proyecciones p
					LEFT JOIN peliculas pp on p.id_pelicula = pp.id_pelicula
					LEFT JOIN salas s on p.id_sala = s.id_sala
					LEFT JOIN sucursales suc on s.id_sucursal = suc.id_sucursal
					WHERE YEAR(p.horario) like '$anio' AND 
					MONTH(p.horario) like '$mes' AND 
					DAY(p.horario) BETWEEN '$fechas[0]' AND '$fechas[1]'
					ORDER BY pp.titulo");
				return $this->db->fetchAll();
		}

			if ($selec == 3){
				$selec = time();
				$mes = date('n', $selec);
				$anio = date('Y', $selec);

				$this->db->query("SELECT p.id_proyeccion, p.id_pelicula, p.id_sala, DATE_FORMAT(p.horario, '%d/%m/%Y %H:%i') as fecha, pp.titulo, pp.duracion, s.nombre, s.id_sala, suc.descripcion
					FROM proyecciones p
					LEFT JOIN peliculas pp on p.id_pelicula = pp.id_pelicula
					LEFT JOIN salas s on p.id_sala = s.id_sala
					LEFT JOIN sucursales suc on s.id_sucursal = suc.id_sucursal
					WHERE YEAR(p.horario) like '$anio' AND
					MONTH(p.horario) like '$mes'
					ORDER BY pp.titulo");
				return $this->db->fetchAll();
			}
	}
		//CALCULAR FECHAS
		private function getFechas($fecha1, $fecha2) {
	   		date_default_timezone_set('America/Argentina/Buenos_Aires'); 
			$fecha_inicio = new DateTime($fecha1);
        	$fecha_fin = new DateTime($fecha2.' +1 day');

        	$intervalo = new DatePeriod($fecha_inicio, new DateInterval('P1D'), $fecha_fin);
        	//var_dump($intervalo);
        	foreach($intervalo as $date){
            $array_fechas[] = $date->format("d-m-Y");
        	}
	    	return $array_fechas;
		}

		//CALCULAR SEMANA
		private function getDiasSemana(){

			date_default_timezone_set('America/Argentina/Buenos_Aires'); 
			$lunes = strtotime("last monday"); //Unix timestamp
			//Unix time (also known as Epoch time, POSIX time...) is a system for describing a point in time. It is the number of seconds that have elapsed since the Unix epoch, minus leap seconds; the Unix epoch is 00:00:00 UTC on 1 January 1970 (an arbitrary date); leap seconds are ignored.	Los dias siempre tienen 86400 segundos entonces??

			//'w' = 0 (para domingo) hasta 6 (para sábado)
			$semana= date('w', $lunes); //1
			if ($semana == date('w')) { 
				//No estamos en la misma semana, le agregamos 7 dias
				$lunes = $lunes+7*86400;
			}

			//Dates in the m/d/y or d-m-y formats are disambiguated by looking at the separator between the various components: if the separator is a slash (/), then the American m/d/y is assumed; whereas if the separator is a dash (-) or a dot (.), then the European d-m-y format is assumed.
			$domingo = strtotime(date("d-m-Y",$lunes)." +6 days");

			$lunes = date("d", $lunes);
			$domingo = date("d", $domingo);
			$array = array ($lunes, $domingo);
			return $array;
		}
		//Get duracion pelicula
		private function getDuracionPelicula ($id){
			$this->db->query("SELECT duracion FROM peliculas
							WHERE id_pelicula = $id");
			return $this->db->fetchAll();
		}


		//ALTAS
		public function cargarProyecciones($pelicula, $sala, $horario, $fecha1, $fecha2, $dias){

			//VALIDACIONES			
			if(!ctype_digit($pelicula)) throw new ExcepcionProyeccion("Error en el ID de la pelicula.");
			if(!ctype_digit($sala)) throw new ExcepcionProyeccion("Error en el ID de la sala.");

			//Validacion de fecha
			$fecha_validar  = explode('-', $fecha1);	
			if (!(checkdate($fecha_validar[1], $fecha_validar[2], $fecha_validar[0]))){
			        throw new ExcepcionProyeccion("Error: la fecha de la primera proyección no es valida.");
			}
			$fecha_validar  = explode('-', $fecha2);	
			if (!(checkdate($fecha_validar[1], $fecha_validar[2], $fecha_validar[0]))){
			        throw new ExcepcionProyeccion("Error: la fecha de la última proyección no es valida.");
			}
			//Fecha de inicio no puede ser menor al estreno de la pelicula
			$this->db->query("SELECT * FROM peliculas
							WHERE id_pelicula = $pelicula AND
							estreno <= '$fecha1'");
			if($this->db->numRows()<1) throw new ExcepcionProyeccion("Error: la fecha de la primera proyeccion no puede ser anterior al estreno de la pelicula.");


			//Validacion array de dias y horario
			foreach ($dias as $valor) {
				if(!ctype_digit($valor)) throw new ExcepcionProyeccion("Error en la selección de dias.");
			}
			if (strtotime($horario) === false) throw new ExcepcionProyeccion("Error en el horario.");

			/*Evitar pisar otras proyecciones, la sala se usa
			lo que dure la pelicula mas 10 min para limpiarla
			a la proyec que quiero agregar le quito 10 min al inicio y sumo 10
			al final, si hay otras proyecs en ese rango horario no se puede
			agregar*/
			$time = new DateTime($horario);
			$array = $this->getFechas($fecha1, $fecha2); 
			$duracion = $this->getDuracionPelicula($pelicula);
			$minutosAgregar = $duracion[0]["duracion"] + 20;
			$minutosExtra = new DateInterval("PT10M");

			foreach ($array as $value) {    		
	    		$dia_semana = new DateTime($value);
	    		if (in_array($dia_semana->format('N'), $dias)){
	    			//Le quito los 10 min entre cada proyeccion
	    			$time->sub($minutosExtra);
	    			$dia_semana->setTime($time->format('H'), $time->format('i'), $time->format('s'));			
	    			//Lo paso a string
	    			$horario_inicio= $dia_semana->format('Y/m/d H:i:s');
	    			
	    			//Aca sumo 20 min, los 10 q corresponden y los 10 q sustraje previamente
	    			$horario_fin = $dia_semana->add(new DateInterval('PT' . $minutosAgregar . 'M'));
	    			//Lo paso a string
	    			$horario_fin= $horario_fin->format('Y/m/d H:i:s');

	    			//Si ya existen proyecciones dentro de ese rango horario
	    			$this->db->query("SELECT * from proyecciones WHERE
	    						id_sala = $sala AND
	    						horario BETWEEN '$horario_inicio' AND '$horario_fin' 
	    						OR horario_fin BETWEEN '$horario_inicio' AND '$horario_fin'");
	    			if($this->db->numRows()>=1) throw new ExcepcionProyeccion("Ya existe una proyeccion en ese horario y sala.");

	    		}
	    	}

			//FINALMENTE INSERT --- vuelvo a cargar las variables sin los 10 min extra
			$time = new DateTime($horario);
			$duracion = $this->getDuracionPelicula($pelicula);
			$minutosAgregar = $duracion[0]["duracion"];

			//EVALUAR DIAS
			$array = $this->getFechas($fecha1, $fecha2);
	    	foreach ($array as $value) {    		
	    		$dia_semana = new DateTime($value);
	    		//N	Representación numérica ISO-8601 del día de la semana (añadido en PHP 5.1.0)	1 (para lunes) hasta 7 (para domingo)
	    		if (in_array($dia_semana->format('N'), $dias)){
	    				
	    			$dia_semana->setTime($time->format('H'), $time->format('i'), $time->format('s'));
	    			$horario_inicio= $dia_semana->format('Y/m/d H:i:s'); //aca es un string de nuevo

	    			$horario_final = $dia_semana->add(new DateInterval('PT' . $minutosAgregar . 'M'));
	    			$horario_final= $horario_final->format('Y/m/d H:i:s');
	    			
	    			//INSERT en tabla PROYECCIONES
	    			$this->db->query("INSERT INTO proyecciones (id_pelicula, id_sala, horario, horario_fin) VALUES ($pelicula, $sala, '$horario_inicio', '$horario_final')");

	    			//INSERT en tabla PRECIOSDEPROYECCIONES
	    			$last_id = $this->db->insertId();

	    			$dia_comparar = $dia_semana->format('N');
	    			$dia_comparar = $dia_comparar - 1; //xq en la bdd dias esta en formato 0 a 6

					$this->db->query("SELECT id_precio FROM precios 
						WHERE dia = $dia_comparar");
					$array_precios = $this->db->fetchAll();

					for ($i=0; $i<count($array_precios); $i++){
						$id_precio = $array_precios[$i]["id_precio"];
						
						$this->db->query("INSERT INTO preciosdeproyecciones (id_precio, id_proyeccion) VALUES ($id_precio, $last_id)");
					}


	    		}
	    	}
		}
		//FLAG EXISTE PELICULA
		private function flagProyeccionID($id){
			$this->db->query("SELECT * FROM proyecciones
								WHERE id_proyeccion = $id LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//BAJAS
		public function borrarProyecciones($id){

			//VALIDACIONES
			if(!ctype_digit($id)) throw new ExcepcionProyeccion("Error en el ID de la proyeccion.");
			if($id < 1) throw new ExcepcionProyeccion("Error en el ID de la proyeccion.");
			
			if(!($this->flagProyeccionID($id))) throw new ExcepcionProyeccion("Error: no existe la proyeccion que desea eliminar o ya ha sido eliminada.");
			
			$this->db->query("DELETE FROM proyecciones WHERE id_proyeccion = $id");
			$this->db->query("DELETE FROM preciosdeproyecciones WHERE id_proyeccion = $id");
		}			
	}

	class ExcepcionProyeccion extends Exception {}
