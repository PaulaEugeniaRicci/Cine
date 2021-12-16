<?php

	// ../models/Pagos.php

	class Pagos extends Model {
		
		//VERIFICAR TARJETA
		public function verificarPago($nro_tarjeta, $digito, $seguridad, $metodo, $caducidad){

			if ($nro_tarjeta < 16) throw new ExcepcionPago("Error: Revise la cantidad de digitos de su tarjeta.");
			if ($seguridad < 3) throw new ExcepcionPago("Error: El código de seguridad no es valido.");
			//if ($metodo == 1 and $digito != 4) throw new ExcepcionPago("Error: La clave de la tarjeta Visa ingresada no es valida.");
			//if ($metodo == 2 and $digito != 5) throw new ExcepcionPago("Error: La clave de la tarjeta Mastercard ingresada no es valida.");
			
			$hoy = (new DateTime())->format('Y-m-d'); 
			$expiry = (new DateTime($caducidad))->format('Y-m-d');

			if ($hoy > $expiry) throw new ExcepcionPago("Error: Su tarjeta está expirada. $fecha -- $caducidad");
		
		}


		//ALTAS
		public function cargarClientes($dni, $nombre, $apellido, $telefono, $email){

			//VALIDACIONES
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$email= trim ($email);

			$nombre = $this->db->escape($nombre);
			$nombre = $this->db->escapeWildCards($nombre);
			$apellido = $this->db->escape($apellido);
			$apellido = $this->db->escapeWildCards($apellido);
			$email = $this->db->escape($email);
			$email = $this->db->escapeWildCards($email);
			
			if(!ctype_digit($dni)) throw new ExcepcionPago("Error: el DNI debe ser numerico.");
			if(!ctype_digit($telefono)) throw new ExcepcionPago("Error: el telefono debe ser numerico.");

			//Evitar cargar el mismo cliente de nuevo
			$this->db->query("SELECT * FROM clientes WHERE dni_cliente = $dni");
			if($this->db->numRows()==0){
				//INSERT
				$this->db->query("INSERT INTO clientes (dni_cliente, nombre, apellido, telefono, email) VALUES ($dni, '$nombre', '$apellido', $telefono, '$email'); ");
			}
		}


		public function cargarPagos($metodo, $nro_tarjeta, $monto, $dni, $proyeccion, $cant_entradas){

			//VALIDACIONES
			$monto = trim ($monto);

			if(!ctype_digit($metodo)) throw new ExcepcionPago("Error: el metodo de pago debe ser numerico.");
			if(!ctype_digit($nro_tarjeta)) throw new ExcepcionPago("Error: el nro de tarjeta debe ser numerico.");
			
			//FECHA
			$fecha = new DateTime();
			$fecha= $fecha->format('Y/m/d H:i:s');

			//VERIFICACION EXTRA SOBRE ENTRADAS
			$result= $this->db->query("SELECT COUNT(*) AS 'cant' FROM entradas WHERE id_proyeccion = $proyeccion ");
			$entradas = $this->db->fetch($result);
			$entradas = $entradas['cant'] + $cant_entradas;

			$result = $this->db->query("SELECT s.cant_asientos as 'asientos' FROM salas s
				WHERE s.id_sala IN (SELECT p.id_sala FROM proyecciones p WHERE p.id_proyeccion = $proyeccion)");
			$asientos = $this->db->fetch($result);
			$asientos = $asientos['asientos'];

			if($asientos<$entradas) throw new ExcepcionPago("Error: no hay $cant_entradas disponibles para esa función.");
			
			//INSERT pagos
			$this->db->query("INSERT INTO pagos (fecha, metodo, nro_tarjeta, monto, estado) VALUES ('$fecha', $metodo, $nro_tarjeta, '$monto', 'pendiente'); ");
			$last_id = $this->db->insertId();

			//INSERT entradas
			for ($i = 0; $i < $cant_entradas; $i++) { 
				$this->db->query("INSERT INTO entradas (id_proyeccion, id_pago, dni_cliente) VALUES ($proyeccion, $last_id, $dni); ");
			}
		}

		//Parte administrativa - recaudacion

		public function getResumenSucursal($sucursal){
			$this->db->query("SELECT * FROM pagos");
		}
	}
	class ExcepcionPago extends Exception {}

