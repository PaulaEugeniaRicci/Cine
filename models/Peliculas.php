<?php

	// ../models/Peliculas.php

	class Peliculas extends Model {
		
		//RETORNAR TODAS LAS FILAS 
		public function getTodos(){
			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.idioma_original, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.idioma_original = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				group by p.id_pelicula
				");
			return $this->db->fetchAll();
		}

		//BUSCAR POR NOMBRE
		public function getPelisTitulo($valor){
			
			//FALTAN VALIDACIONES

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.idioma_original, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.idioma_original = i.id_idioma
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
			
			//FALTAN VALIDACIONES

			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.idioma_original, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.idioma_original = i.id_idioma
				LEFT JOIN generosdepeliculas gp ON p.id_pelicula = gp.id_pelicula
				LEFT JOIN generos g ON gp.id_genero = g.id_genero
				WHERE p.id_clasificacion = $valor
				group by p.id_pelicula
				");

				if($this->db->numRows()<1) throw new ExcepcionPelicula("Error: No se encontraron peliculas con esa clasificacion.");

				return $this->db->fetchAll();
			
		}


		//FLAG EXISTE PELICULA
		private function getPeliculaID($id){
			$this->db->query("SELECT p.id_pelicula, p.id_clasificacion, p.idioma_original, p.subtitulado, p.titulo, p.director, p.descripcion, p.duracion, p.estreno, c.descripcion_clasificacion, i.descripcion_idioma, GROUP_CONCAT(g.descripcion_genero SEPARATOR ', ') as genero
				FROM peliculas p 
				LEFT JOIN clasificaciones c ON p.id_clasificacion = c.id_clasificacion
				LEFT JOIN idiomas i ON p.idioma_original = i.id_idioma
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

			//VALIDACIONES - las removi para hacerlas a lo ultimo

			//Evitar cargar la misma pelicula - con que parametro hago la comparacion?
			
			//INSERT en tabla PELICULAS
			$this->db->query("INSERT INTO peliculas (titulo, director, id_clasificacion, duracion, idioma_original, subtitulado, descripcion, estreno, poster, trailer) VALUES ('$titulo', '$director', $clasificacion, $duracion, $idioma, '$subtitulado', '$sinopsis', '$fecha', '$poster', '$trailer'); ");


			//INSERT en tabla GENEROSDEPELICULAS
			$last_id = $this->db->insertId();
			foreach ($genero as $k => $valor) {
				$this->db->query("INSERT INTO generosdepeliculas (id_pelicula, id_genero) VALUES ($last_id, $valor); ");
			}
		}

		/*MODIFICACIONES
		public function modificarEmpleados($id, $nombre, $apellido, $telefono, $direccion, $cuit, $sucursal, $usuario, $contrasenia){

			//VALIDACIONES PRIMERA PARTE
			if(!ctype_digit($id)) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if($id < 1) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if(!($this->getEmpleadoID($id))) throw new ExcepcionEmpleado("Error: no existe el empleado que desea modificar.");

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			

			//SET DATOS y MAS VALIDACIONES
			$consulta = "UPDATE empleados set ";
			$flag=0;
			if (!empty($nombre)){
				if (preg_match($regex, $nombre)) throw new ExcepcionEmpleado("Error: se ingreso un nombre no valido.");
				$nombre = trim($nombre);
				$consulta.="nombre='".$nombre."'";
				$flag=1;
			}
			if (!empty($apellido)){
				if (preg_match($regex, $apellido)) throw new ExcepcionEmpleado("Error: se ingreso un apellido no valido.");
				$apellido = trim($apellido);
				if($flag==1) $consulta.=",apellido='".$apellido."'";
				else
				$consulta.="apellido='".$apellido."'";
				$flag=1;
			}
			if (!empty($telefono)){
				if(!ctype_digit($telefono)) throw new ExcepcionEmpleado("Error: el telefono debe ser numerico.");
				$telefono = trim ($telefono);
				if($flag==1) $consulta.=",telefono=".$telefono;
				else
				$consulta.=",telefono=".$telefono;
				$flag=1;
			}
			if (!empty($direccion)){
				if (preg_match($regex, $direccion)) throw new ExcepcionEmpleado("Error: la direccion contiene caracteres no permitidos.");
				$direccion = trim($direccion);
				if($flag==1) $consulta.=",direccion='".$direccion."'";
				else
				$consulta.="direccion='".$direccion."'";
				$flag=1;			
			}
			if (!empty($cuit)){
				if(!ctype_digit($cuit)) throw new ExcepcionEmpleado("Error: el CUIT debe ser numerico.");
				$cuit = trim ($cuit);
				if($flag==1) $consulta.=",cuit= ".$cuit;
				else
				$consulta.="cuit= ".$cuit;
				$flag=1;
			}
			if (!empty($sucursal)){
				if(!ctype_digit($sucursal)) throw new ExcepcionEmpleado("Error en la sucursal.");
				if($flag==1) $consulta.=",id_sucursal= ".$sucursal;
				else
				$consulta.="id_sucursal= ".$sucursal;
				$flag=1;
			}

			$consulta.=" WHERE id_empleado= ".$id;
			var_dump($consulta);
			$this->db->query($consulta);
		}*/


		//BAJAS
		public function borrarPeliculas($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			if($id < 1) throw new ExcepcionPelicula("Error en el ID de la pelicula.");
			
			if(!($this->getPeliculaID($id))) throw new ExcepcionPelicula("Error: no existe la pelicula que desea eliminar o ya ha sido eliminada.");
			
			$this->db->query("DELETE FROM peliculas WHERE id_pelicula = $id");

			//BAJA en tabla GENEROSDEPELICULAS
			$this->db->query("DELETE FROM generosdepeliculas WHERE id_pelicula = $id");
		}


	}

	class ExcepcionPelicula extends Exception {}

