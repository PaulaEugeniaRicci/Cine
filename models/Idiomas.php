<?php

	// ../models/Idiomas.php

	class Idiomas extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM idiomas");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionIdioma extends Exception {}

