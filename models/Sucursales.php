<?php

	// ../models/Sucursales.php

	class Sucursales extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM sucursales");
			return $this->db->fetchAll();
		}

		//RETORNAR POR ID
		public function getById($id_sucursal){
			$this->db->query("SELECT localidad, descripcion FROM sucursales 
				WHERE id_sucursal = $id_sucursal");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionSucursal extends Exception {}

