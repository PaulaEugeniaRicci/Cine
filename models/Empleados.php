<?php

	// ../models/Empleados.php

	class Empleados extends Model {
		
		//BUSCAR POR APELLIDO/CUIT
		public function getEmpleadosFiltro($valor){
			
			$valor = trim($valor);
			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#_]+/i";
			//El regular expression de arriba contiene los caracteres comodines
			if (preg_match($regex, $valor)) throw new ExcepcionEmpleado("Error: El CUIT debe incluir solo numeros, y el apellido solo letras y espacios.");

			//POR CUIT
			if (ctype_digit($valor)){
				
				if (strlen($valor)> 15) throw new ExcepcionEmpleado("Error: el CUIT debe tener la cantidad correcta de digitos.");

				$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuit, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE cuit = $valor");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontro un empleado con ese CUIT.");

				return $this->db->fetchAll();
			}
			//POR APELLIDO	
			else {
				
				$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuit, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE apellido like '$valor'");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontro un empleado con ese apellido.");

				return $this->db->fetchAll();
			}

		}

		//BUSCAR POR SUCURSAL
		public function getEmpleadosSucursal ($valor){

			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuit, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal
								WHERE e.id_sucursal = $valor");

				if($this->db->numRows()<1) throw new ExcepcionEmpleado("Error: No se encontraron empleados correspondientes a esa sucursal.");

				return $this->db->fetchAll();
		}

		//FLAG EXISTE EMPLEADO
		private function getEmpleadoID($id){
			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuit, e.telefono, e.direccion, s.descripcion
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
			$this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, e.cuit, e.telefono, e.direccion, s.descripcion
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_sucursal = s.id_sucursal");

			return $this->db->fetchAll();
		}

		
		//ALTAS
		public function cargarEmpleados($nombre, $apellido, $telefono, $direccion, $cuit, $sucursal, $usuario, $contrasenia){

			//VALIDACIONES
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$telefono = trim ($telefono);
			$direccion = trim($direccion);
			$cuit = trim ($cuit);

			$contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) throw new ExcepcionEmpleado("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $apellido)) throw new ExcepcionEmpleado("Error: se ingreso un apellido no valido.");

			if(!ctype_digit($telefono)) throw new ExcepcionEmpleado("Error: el telefono debe ser numerico.");

			if (preg_match($regex, $direccion)) throw new ExcepcionEmpleado("Error: la direccion contiene caracteres no permitidos.");

			if(!ctype_digit($cuit)) throw new ExcepcionEmpleado("Error: el CUIT debe ser numerico.");

			if(!ctype_digit($sucursal)) throw new ExcepcionEmpleado("Error en la sucursal.");

			//Evitar cargar el mismo empleado de nuevo
			$this->db->query("SELECT *
								FROM empleados e
								LEFT JOIN sucursales s ON e.id_empleado = s.id_sucursal
								WHERE cuit = $cuit");
			if($this->db->numRows()>=1) throw new ExcepcionEmpleado("Error: ya existe un empleado con ese CUIT.");
			
			//INSERT
			$this->db->query("INSERT INTO empleados (nombre, apellido, telefono, direccion, cuit, id_sucursal, usuario, contrasenia) VALUES ('$nombre', '$apellido', $telefono, '$direccion', $cuit, $sucursal, '$usuario', '$contrasenia'); ");
		}

		
		//MODIFICACIONES
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
		}

		
		//BAJAS
		public function borrarEmpleados($id){

			//VALIDACION
			if(!ctype_digit($id)) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			if($id < 1) throw new ExcepcionEmpleado("Error en el ID del empleado.");
			
			if(!($this->getEmpleadoID($id))) throw new ExcepcionEmpleado("Error: no existe el empleado que desea eliminar o ya ha sido eliminado.");
			
			$this->db->query("DELETE from empleados WHERE id_empleado = $id");
		}
		
		
	}

	class ExcepcionEmpleado extends Exception {}

