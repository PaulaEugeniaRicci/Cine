<?php

	// ../models/Clasificaciones.php

	class Clasificaciones extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM clasificaciones");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionClasificacion extends Exception {}

