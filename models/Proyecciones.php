<?php

	// ../models/Proyecciones.php

	class Proyecciones extends Model {
		
		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM proyecciones");
			return $this->db->fetchAll();
		}

		//ALTAS
		public function cargarProyecciones($pelicula, $sala, $horario, $fecha1, $fecha2, $dias){

			//VALIDACIONES - las removi para hacerlas a lo ultimo

			//Evitar cargar las mismas proyecciones que dios me ayude
			//La sala se usa lo que dure la pelicula mas 20 min para limpiarla
			//Los horarios posiblemente sean un array, por ahora será UN SOLO HORARIO

			//Select sala y horario, if yes then excepcion
			//else INSERT

			$this->db->query("SELECT * FROM proyecciones
								WHERE id_sala = $sala");

			if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontro un empleado con ese apellido.");
			
			//INSERT en tabla PELICULAS
			$this->db->query("INSERT INTO peliculas (titulo, director, id_clasificacion, duracion, idioma_original, subtitulado, descripcion, estreno, poster, trailer) VALUES ('$titulo', '$director', $clasificacion, $duracion, $idioma, '$subtitulado', '$sinopsis', '$fecha', '$poster', '$trailer'); ");


			//INSERT en tabla GENEROSDEPELICULAS
			$last_id = $this->db->insertId();
			foreach ($genero as $k => $valor) {
				$this->db->query("INSERT INTO generosdepeliculas (id_pelicula, id_genero) VALUES ($last_id, $valor); ");
			}
		}	
		
	}

	class ExcepcionProyeccion extends Exception {}
