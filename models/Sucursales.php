<?php

	// ../models/Sucursales.php

	class Sucursales extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM sucursales");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionSucursal extends Exception {}

