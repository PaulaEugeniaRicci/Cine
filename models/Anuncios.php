<?php

	// ../models/Anuncios.php

	class Anuncios extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT *
				FROM anuncios");

			return $this->db->fetchAll();
		}

		public function cargarAnuncio($imagen){
			$this->db->query("INSERT INTO anuncios (imagen) VALUES('$imagen')");

		}

		public function bajaAnuncio($id_anuncio){
			$this->db->query("DELETE FROM anuncios WHERE id_anuncio = $id_anuncio");
		}
		
	}

	class ExcepcionAnuncios extends Exception {}