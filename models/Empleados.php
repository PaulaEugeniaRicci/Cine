<?php

	// ../models/Empleados.php

	class Empleados extends Model {
		
		//BUSCAR POR APELLIDO/CUIL
		public function getEmpleadosFiltro($valor){
			
			$valor = trim($valor);
			$valor = $this->db->escape($valor);
			$valor = $this->db->escapeWildCards($valor);
			/*	REEMPLAZO ESTO POR ESCAPE Y ESCAPEWILDCARDS 
			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#_]+/i";
			El regular expression de arriba contiene los caracteres comodines
			if (preg_match($regex, $valor)) throw new ExcepcionEmpleado("Error: El CUIL debe incluir solo numeros, y el apellido solo letras y espacios.");*/

			//POR CUIL
			if (ctype_digit($valor)){
				
				if (strlen($valor)> 11) throw new ExcepcionEmpleado("Error: el CUIL debe tener la cantidad correcta de digitos.");

				$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE cuil = $valor");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontro un empleado con ese CUIL.");
				return $this->db->fetchAll();
			}
			//POR APELLIDO	
			else {
				
				$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE apellido like '$valor'");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontro un empleado con ese apellido.");
				return $this->db->fetchAll();
			}

		}

		//BUSCAR POR SUCURSAL
		public function getEmpleadosSucursal ($valor){
			if(!ctype_digit($valor)) throw new ExcepcionEmpleado("Error en el ID de la sucursal.");

			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE e.id_sucursal = $valor");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontraron empleados correspondientes a esa sucursal.");
				return $this->db->fetchAll();
		}


		//BUSCAR POR ID
		public function getEmpleadoById($id){

			//Validacion
			if(!ctype_digit($id)) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if($id < 1) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			//
			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion, e.id_sucursal
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE id_empleado = $id");
			return $this->db->fetchAll();
		}

		//FLAG EXISTE EMPLEADO
		private function flagEmpleadoID($id){
			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE id_empleado = $id LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuil, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal");
			return $this->db->fetchAll();
		}

		
		//ALTAS
		public function cargarEmpleados($nombre, $apellido, $telefono, $direccion, $cuil, $sucursal){

			//VALIDACIONES
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$telefono = trim ($telefono);
			$direccion = trim($direccion);
			$cuil = trim ($cuil);

			$nombre = $this->db->escape($nombre);
			$nombre = $this->db->escapeWildCards($nombre);
			$apellido = $this->db->escape($apellido);
			$apellido = $this->db->escapeWildCards($apellido);
			$direccion = $this->db->escape($direccion);
			$direccion = $this->db->escapeWildCards($direccion);

			if(!ctype_digit($telefono)) throw new ExcepcionEmpleado("Error: el telefono debe ser numerico.");
			if(!ctype_digit($cuil)) throw new ExcepcionEmpleado("Error: el CUIL debe ser numerico.");
			if(!ctype_digit($sucursal)) throw new ExcepcionEmpleado("Error en la sucursal.");

			//Evitar cargar el mismo empleado de nuevo
			$this->db->query("SELECT *
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_empleado = s.id_sucursal
								WHERE cuil = $cuil");
			if($this->db->numRows()>=1) throw new ExcepcionEmpleado("Error: ya existe un empleado con ese CUIL.");
			
			//INSERT
			$this->db->query("INSERT INTO empleados (nombre, apellido, telefono, direccion, cuil, id_sucursal) VALUES ('$nombre', '$apellido', $telefono, '$direccion', $cuil, $sucursal); ");
		}

		//FUNCIONES PARA VALIDAR MODIFICACION
		private function getIdEmpleado($cuil){
		$this->db->query("SELECT id_empleado FROM empleados WHERE cuil = $cuil");
			return $this->db->fetchAll();		
		}

		private function verificarCuil($id, $cuil){
			$aux = $this->getIdEmpleado($cuil);
			$flag = 0;
			foreach ($aux as $key => $value) {
				var_dump($value);
				if ($value['id_empleado'] != $id){
					throw new ExcepcionEmpleado("Error: ya existe un empleado con ese CUIL.");
					$flag = 1;
				}		
			}
			return $flag;
		}

		//MODIFICACIONES
		public function modificarEmpleados($id, $nombre, $apellido, $telefono, $direccion, $cuil, $sucursal){

			//VALIDACIONES parte 1 - Campos
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$telefono = trim ($telefono);
			$direccion = trim($direccion);
			$cuil = trim ($cuil);

			$nombre = $this->db->escape($nombre);
			$nombre = $this->db->escapeWildCards($nombre);
			$apellido = $this->db->escape($apellido);
			$apellido = $this->db->escapeWildCards($apellido);
			$direccion = $this->db->escape($direccion);
			$direccion = $this->db->escapeWildCards($direccion);

			if(!ctype_digit($telefono)) throw new ExcepcionEmpleado("Error: el telefono debe ser numerico.");
			if(!ctype_digit($cuil)) throw new ExcepcionEmpleado("Error: el CUIL debe ser numerico.");
			if(!ctype_digit($sucursal)) throw new ExcepcionEmpleado("Error en la sucursal.");

			//VALIDACIONES parte 2 - Id
			if(!ctype_digit($id)) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if($id < 1) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if(!($this->flagEmpleadoID($id))) throw new ExcepcionEmpleado("Error: no existe el empleado que desea modificar.");

			//UPDATE y validacion final
			if ($this->verificarCuil($id, $cuil) == 0){
				$this->db->query("UPDATE empleados SET nombre= '$nombre',  apellido = '$apellido', telefono = $telefono, direccion= '$direccion', cuil = $cuil, id_sucursal= $sucursal
					WHERE id_empleado = $id");		
			}					
		}	
		
		//BAJAS
		public function borrarEmpleados($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if($id < 1) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			
			if(!($this->flagEmpleadoID($id))) throw new ExcepcionEmpleado("Error: no existe el empleado que desea eliminar o ya ha sido eliminado.");
			
			$this->db->query("DELETE from empleados WHERE id_empleado = $id");
		}	
	}

	class ExcepcionEmpleado extends Exception {}

