<?php

	// ../models/Peliculas.php

	class Peliculas extends Model {

		//RETORNAR TODAS LAS FILAS 
		public function getTodos(){
			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, p.poster, p.trailer, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				group by p.id_pelicula
				");
			return $this->db->fetchAll();
		}

		//BUSCAR POR ID
		public function getPelicula($id_pelicula){
			if(!ctype_digit($id_pelicula)) throw new ExcepcionPelicula("Error en el ID de la pelicula.");

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, p.poster, p.trailer, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				WHERE p.id_pelicula = $id_pelicula
				 ");

			return $this->db->fetchAll();
		}

		/*BUSCAR POR SUCURSAL
		public function getPelisSucursal(){ //hay que modificarlo
			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.idioma_original, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, p.poster, p.trailer, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.idioma_original = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				group by p.id_pelicula
				");
			return $this->db->fetchAll();
		}*/

		//METODOS PAULA
		//BUSCAR GENEROS DE UNA PELI
		public function getGenerosPelis($id){
			
			//VALIDACIONES
			if(!ctype_digit($id)) throw new ExcepcionPelicula("Error en el ID de la pelicula.");

			$this->db->query("SELECT id_genero FROM generosdepeliculas
				WHERE id_pelicula = $id
				");

			if($this->db->numRows()<1) throw new ExcepcionPelicula("Error: No se encontraron generos para esa pelicula.");
				return $this->db->fetchAll();
		}

		//BUSCAR POR NOMBRE
		public function getPelisTitulo($valor){
			
			//VALIDACIONES
			$valor= $this->db->escape($valor);
			$valor = $this->db->escapeWildCards($valor);

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, p.trailer, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				WHERE p.titulo LIKE '%$valor%'
				group by p.id_pelicula
				");

				if($this->db->numRows()<1) throw new ExcepcionPelicula("Error: No se encontro una pelicula con ese titulo.");

				return $this->db->fetchAll();
			
		}

		//BUSCAR POR CLASIFICACION
		public function getPelisClasificacion($valor){
			
			//VALIDACIONES
			if(!ctype_digit($valor)) throw new ExcepcionPelicula("Error en el ID clasificacion.");

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, p.trailer, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				WHERE p.id_clasificacion = $valor
				group by p.id_pelicula
				");

				if($this->db->numRows()<1) throw new ExcepcionPelicula("Error: No se encontraron peliculas con esa clasificacion.");

				return $this->db->fetchAll();
			
		}


		//FLAG EXISTE PELICULA
		private function flagPeliculaID($id){
			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.id_idioma, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.id_idioma = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				WHERE p.id_pelicula = $id
				group by p.id_pelicula
				");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//ALTAS
		public function cargarPeliculas($titulo, $genero, $director, $clasificacion, $duracion, $idioma, $subtitulado, $sinopsis, $fecha, $poster, $trailer){

			//VALIDACIONES			
			$titulo = trim($titulo);
			$director = trim($director);
			$subtitulado = trim($subtitulado);
			$sinopsis = trim($sinopsis);

			$titulo = $this->db->escape($titulo);
			$titulo = $this->db->escapeWildCards($titulo);
			$director = $this->db->escape($director);
			$director = $this->db->escapeWildCards($director);
			$subtitulado = $this->db->escape($subtitulado);
			$subtitulado = $this->db->escapeWildCards($subtitulado);
			$sinopsis = $this->db->escape($sinopsis);
			$sinopsis = $this->db->escapeWildCards($sinopsis);

			if(!ctype_digit($clasificacion)) throw new ExcepcionPelicula("Error en el ID de la clasificacion.");
			if(!ctype_digit($duracion)) throw new ExcepcionPelicula("Error: la duración debe ser numerica.");
			if(!ctype_digit($idioma)) throw new ExcepcionPelicula("Error en el ID del idioma.");

			//Validacion de fecha
			/*$fecha_validar  = explode('-', $fecha);	
			if (!(checkdate($fecha_validar[2], $fecha_validar[1], $fecha_validar[0]))){
			        throw new ExcepcionPelicula("Error: la fecha no es valida.");
			}*/
			
			////Evitar cargar la misma pelicula, los parametros son titulo y subtitulado
			$this->db->query("SELECT *
								FROM peliculas 
								WHERE titulo LIKE '%$titulo%' AND
								subtitulado LIKE '%$subtitulado%'");
			if($this->db->numRows()>=1) throw new ExcepcionPelicula("Error: ya existe una pelicula cargada con los mismos datos.");
			
			//INSERT en tabla PELICULAS
			$this->db->query("INSERT INTO peliculas (titulo, director, id_clasificacion, duracion, id_idioma, subtitulado, descripcion, estreno, poster, trailer) VALUES ('$titulo', '$director', $clasificacion, $duracion, $idioma, '$subtitulado', '$sinopsis', '$fecha', '$poster', '$trailer'); ");

			//INSERT en tabla GENEROSDEPELICULAS
			$last_id = $this->db->insertId();
			foreach ($genero as $k => $valor) {
				//Validacion de genero
				if(!ctype_digit($valor)) throw new ExcepcionPelicula("Error en el ID del genero.");
				//Insert genero
				$this->db->query("INSERT INTO generosdepeliculas (id_pelicula, id_genero) VALUES ($last_id, $valor); ");
			}
		}

		//FUNCIONES PARA VALIDAR MODIFICACION
		private function getIdPelicula($titulo, $subtitulado){
		$this->db->query("SELECT id_pelicula
								FROM peliculas 
								WHERE titulo LIKE '%$titulo%' AND
								subtitulado LIKE '%$subtitulado%'");
			return $this->db->fetchAll();		
		}

		private function verificarDatos($id, $titulo, $subtitulado){
			$aux = $this->getIdPelicula($titulo, $subtitulado);
			$flag = 0;
			foreach ($aux as $key => $value) {
				var_dump($value);
				if ($value['id_pelicula'] != $id){
					throw new ExcepcionPelicula("Error: ya existe una pelicula con esos datos.");
					$flag = 1;
				}		
			}
			return $flag;
		}

		//MODIFICACIONES
		public function modificarPeliculas($id, $titulo, $genero, $director, $clasificacion, $duracion, $idioma, $subtitulado, $sinopsis, $fecha, $poster, $trailer){

			//VALIDACIONES 
			$titulo = trim($titulo);
			$director = trim($director);
			$subtitulado = trim($subtitulado);
			$sinopsis = trim($sinopsis);

			$titulo = $this->db->escape($titulo);
			$titulo = $this->db->escapeWildCards($titulo);
			$director = $this->db->escape($director);
			$director = $this->db->escapeWildCards($director);
			$subtitulado = $this->db->escape($subtitulado);
			$subtitulado = $this->db->escapeWildCards($subtitulado);
			$sinopsis = $this->db->escape($sinopsis);
			$sinopsis = $this->db->escapeWildCards($sinopsis);

			if(!ctype_digit($clasificacion)) throw new ExcepcionPelicula("Error en el ID de la clasificacion.");
			if(!ctype_digit($duracion)) throw new ExcepcionPelicula("Error: la duración debe ser numerica.");
			if(!ctype_digit($idioma)) throw new ExcepcionPelicula("Error en el ID del idioma.");

			//Validacion de fecha
			$fecha_validar  = explode('-', $fecha);	
			if (!(checkdate($fecha_validar[2], $fecha_validar[1], $fecha_validar[0]))){
			        throw new ExcepcionPelicula("Error: la fecha no es valida.");
			}
			
			//VALIDACIONES parte 2 - Id
			if(!ctype_digit($id)) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			if($id < 1) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			if(!($this->flagPeliculaID($id))) throw new ExcepcionPelicula("Error: no existe la pelicula que desea modificar.");

			//UPDATE en tabla PELICULAS y validacion final
			if ($this->verificarDatos($id, $titulo, $subtitulado) == 0){
				if(empty($poster)){
					//SET en tabla PELICULAS
					$this->db->query("UPDATE peliculas SET titulo= '$titulo',  director = '$director', id_clasificacion = $clasificacion, duracion= $duracion, id_idioma = $idioma, subtitulado= '$subtitulado', descripcion= '$sinopsis', estreno='$fecha', trailer='$trailer'
						WHERE id_pelicula = $id");
				}
				else{
					//SET en tabla PELICULAS
					$this->db->query("UPDATE peliculas SET titulo= '$titulo',  director = '$director', id_clasificacion = $clasificacion, duracion= $duracion, id_idioma = $idioma, subtitulado= '$subtitulado', descripcion= '$sinopsis', estreno='$fecha', poster = '$poster', trailer='$trailer'
						WHERE id_pelicula = $id");
				}
				//DELETE en tabla GENEROSDEPELICULAS	
				$this->db->query("DELETE FROM generosdepeliculas WHERE id_pelicula = $id");
				
				//INSERT en tabla GENEROSDEPELICULAS
				foreach ($genero as $k => $valor) {
					$this->db->query("INSERT INTO generosdepeliculas (id_pelicula, id_genero) VALUES ($id, $valor); ");
				}
			}		
		}


		//BAJAS
		public function borrarPeliculas($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			if($id < 1) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			
			if(!($this->flagPeliculaID($id))) throw new ExcepcionPelicula("Error: no existe la pelicula que desea eliminar o ya ha sido eliminada.");
			
			$this->db->query("UPDATE pagos p
			    JOIN entradas e ON p.id_pago = e.id_pago 
	    		JOIN proyecciones proy ON proy.id_pelicula = $id
				SET p.estado = 'devolucion'");

			$this->db->query("DELETE FROM peliculas WHERE id_pelicula = $id");

			//BAJA en tabla GENEROSDEPELICULAS
			$this->db->query("DELETE FROM generosdepeliculas WHERE id_pelicula = $id");
		}



	}

	class ExcepcionPelicula extends Exception {}

