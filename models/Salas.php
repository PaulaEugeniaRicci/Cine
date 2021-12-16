<?php

	// ../models/Salas.php

	class Salas extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT s.id_sala, s.id_sucursal, s.nombre, s.cant_asientos, suc.id_sucursal, suc.descripcion, suc.direccion 
				FROM salas s
				LEFT JOIN sucursales suc ON s.id_sucursal = suc.id_sucursal
				ORDER BY suc.descripcion, s.nombre");
			return $this->db->fetchAll();
		}

		//BUSCAR POR SUCURSAL
		public function getSalasSucursal($valor){
			$this->db->query("SELECT s.id_sala, s.id_sucursal, s.nombre, s.cant_asientos, suc.id_sucursal, suc.descripcion, suc.direccion 
				FROM salas s
				LEFT JOIN sucursales suc ON s.id_sucursal = suc.id_sucursal
				WHERE s.id_sucursal = $valor
				ORDER BY suc.descripcion, s.nombre");

				if($this->db->numRows()<1) throw new ExcepcionSala("Error: No se encontraron salas correspondientes a esa sucursal.");
				return $this->db->fetchAll();
		}

		//ALTAS
		public function cargarSalas($nombre, $cant_asientos, $sucursal){

			//VALIDACIONES
			$nombre = trim($nombre);
			$nombre = $this->db->escape($nombre);
			$nombre = $this->db->escapeWildCards($nombre);

			if(!ctype_digit($cant_asientos)) throw new ExcepcionSala("Error: la cantidad de asientos debe ser númerica.");
			if(!ctype_digit($sucursal)) throw new ExcepcionSala("Error en la sucursal.");

			//Evitar cargar la misma sala - Criterio: mismo nombre y misma sucursal
			$this->db->query("SELECT *
								FROM salas
								WHERE id_sucursal = $sucursal AND
								nombre LIKE '%$nombre%'");
			if($this->db->numRows()>=1) throw new ExcepcionSala("Error: ya existe una sala con ese nombre en la sucursal elegida.");
			
			//INSERT
			$this->db->query("INSERT INTO salas (id_sucursal, nombre, cant_asientos) VALUES ($sucursal, '$nombre', $cant_asientos); ");
		}

		//BAJAS
		public function borrarSalas($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionSala("Error en el ID de la sala.");
			if($id < 1) throw new ExcepcionSala("Error en el ID de la sala.");

			$this->db->query("UPDATE pagos p
			    JOIN entradas e ON p.id_pago = e.id_pago 
	    		JOIN proyecciones proy ON proy.id_sala = $id
				SET p.estado = 'devolucion'");

			//Directamente elimino todo con las restricciones -on cascade- en la bdd
			$this->db->query("DELETE from salas WHERE id_sala = $id");

			
		}	
	}

	class ExcepcionSala extends Exception {}