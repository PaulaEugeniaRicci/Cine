<?php

	// ../models/Precios.php
	
	/*Const array para tipo de horario y hora en si
	//Variables constantes van fuera de la clase apparently
	//Descartado... 
			define ("horarios", array(
				'mañana' => array("09:00", "12:00"),
				'tarde' => array("12:00", "20:00"),
				'noche' => array("20:00", "23:30"),
				'trasnoche' => array("23:30", "03:00")
				)
			);
	*/
	class Precios extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT p.id_precio, p.descripcion FROM precios p
				GROUP BY p.descripcion");
			return $this->db->fetchAll();
		}

		//RETORNAR TODOS LOS PRECIOS DE LA SEMANA
		public function getPreciosSemana($descripcion){
			$this->db->query("SELECT valor, dia FROM precios
				WHERE descripcion LIKE '$descripcion' ");
			return $this->db->fetchAll();
		}


		//BUSCAR POR ID
		public function getPrecioById($id){
			//VALIDACION
			$id = trim($id);
			$id = $this->db->escape($id);
			$id = $this->db->escapeWildCards($id);

			$this->db->query("SELECT p.id_precio, p.descripcion FROM precios p 
				WHERE id_precio = $id");
			return $this->db->fetchAll();
		}


		//FLAG EXISTE PRECIO
		private function flagPrecioID($id){
			$this->db->query("SELECT * FROM precios
								WHERE id_precio = $id LIMIT 1");
			if($this->db->numRows()!=1){
				return false;
			}
			else return true;
		}

		//FLAG RETORNAR DESCRIPCION
		private function descripcionTipo($id){
			$this->db->query("SELECT descripcion FROM precios
				WHERE id_precio = $id");
			return $this->db->fetchAll();
		}

		//RETORNAR PROYECCIONES
		private function proyeccionDia($dia) {
			$this->db->query("SELECT id_proyeccion, horario FROM proyecciones 
	    				WHERE DATE_FORMAT(horario, '%Y/%m/%d') >= CURDATE()" );
	    			$array_proyecciones = $this->db->fetchAll();
	    			$array_id_proyeccion = array();

	    			for ($i=0; $i<count($array_proyecciones); $i++){
						$id_proyeccion = $array_proyecciones[$i]["id_proyeccion"];
						$horario = $array_proyecciones[$i]["horario"];
	
						$dia_semana = new DateTime($horario);
						$dia_semana = $dia_semana->format('N') - 1;
					
						if ($dia_semana == $dia){
							$array_id_proyeccion[] = $id_proyeccion;
						}
					}
			return $array_id_proyeccion;
		}

		/*/ALTA
		public function cargarPrecios($descripcion, $dias){

			//VALIDACIONES
			$descripcion = trim($descripcion);
			$descripcion = $this->db->escape($descripcion);
			$descripcion = $this->db->escapeWildCards($descripcion);

			//FALTA Evitar cargar el mismo PRECIO - Criterio: misma descripcion
			$this->db->query("SELECT * FROM precios WHERE 
								descripcion LIKE '$descripcion' ");
			if($this->db->numRows()>=1) throw new ExcepcionPrecio("Error: ya existe una tarifa del mismo tipo.");
		
			//INSERT
			foreach ($dias as $key => $value) {

				$this->db->query("INSERT INTO precios (descripcion, dia, valor) VALUES ('$descripcion', $key, $value); ");
			
				//INSERT en tabla PRECIOSDEPROYECCIONES
		    	$last_id = $this->db->insertId();

		    	$resultados = $this->proyeccionDia($key);
		    	foreach ($resultados as $key => $value) {
		    		$this->db->query("INSERT INTO preciosdeproyecciones (id_precio, id_proyeccion) VALUES ($last_id, $value)");
		    	}
			}
		}*/


		//MODIFICAR
		public function modificarPrecios($id, $descripcion, $dias){

			//VALIDACIONES parte 1 - Campos
			$descripcion = trim($descripcion);
			$descripcion = $this->db->escape($descripcion);
			$descripcion = $this->db->escapeWildCards($descripcion);
		
			//VALIDACIONES parte 2 - Id
			if(!ctype_digit($id)) throw new ExcepcionPrecio("Error en el ID del precio.");
			if($id < 1) throw new ExcepcionPrecio("Error en el ID de la tarifa.");
			if(!($this->flagPrecioID($id))) throw new ExcepcionPrecio("Error: no existe la tarifa que desea modificar.");

			//VALIDACIONES parte 3 - No pisar otras tarifas ya existentes 

			$descripcionTipo = $this->descripcionTipo($id);
			$descripcion_anterior = $descripcionTipo[0]["descripcion"];

			$this->db->query("SELECT * FROM precios WHERE descripcion LIKE '$descripcion'");
			if (!empty($this->db->fetchAll()) && ($descripcion != $descripcion_anterior)){
				throw new ExcepcionPrecio("Error: ya existe una tarifa del mismo tipo.");
				
			}
				
			//UPDATE
			foreach ($dias as $key => $value) {
			$this->db->query("UPDATE precios SET descripcion= '$descripcion', valor=$value
				WHERE descripcion LIKE '$descripcion_anterior' AND
				dia = $key");
			}		 			
		}
		
		/*/BAJA
		public function borrarPrecios($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionPrecio("Error en el ID de la tarifa.");
			if($id < 1) throw new ExcepcionPrecio("Error en el ID de la tarifa.");
			if(!($this->flagPrecioID($id))) throw new ExcepcionPrecio("Error: no existe la tarifa que desea modificar.");
			
			$this->db->query("DELETE from precios WHERE id_precio = $id");
		}*/

	}

	class ExcepcionPrecio extends Exception {}