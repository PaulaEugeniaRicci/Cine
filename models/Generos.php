<?php

	// ../models/Generos.php

	class Generos extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM generos order by descripcion_genero");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionGenero extends Exception {}

