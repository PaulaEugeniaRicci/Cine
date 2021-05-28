<?php

	// ../models/Salas.php

	class Salas extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT s.id_sala, s.id_sucursal, s.nombre, s.cant_asientos, suc.id_sucursal, suc.descripcion 
				FROM salas s
				LEFT JOIN sucursales suc ON s.id_sucursal = suc.id_sucursal
				order by suc.descripcion, s.nombre");
			return $this->db->fetchAll();
		}

		
		
	}

	class ExcepcionSala extends Exception {}