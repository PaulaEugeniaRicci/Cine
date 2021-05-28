<?php


// ../fw/Database.php


	class Database {
		private $res;
		private $cn = false;
		private static $instance = false;

		private function __construct (){} // Constructor privado, previene la creación de objetos vía new

		public function getInstance (){ // Singleton, la propia clase es responsable de crear la única instancia, el acceso es mediante un metodo de clase (static)
			if (!self::$instance) self::$instance = new Database;
			return self::$instance;
		}


		public function query ($q){ // CONSULTAS
			if(!$this->cn) $this->connect();
			$this->res = mysqli_query($this->cn, $q);
			if(mysqli_error($this->cn) != ""){
				echo 'ERROR SQL: ' . mysqli_error($this->cn);
				echo ' -- CONSULTA: ' . $q;
			}
		}


		private function connect (){ // CONEXION
			$this->cn = mysqli_connect("localhost", "root", "", "cine");
		} 


		public function fetch (){ // RETORNA FILA
			return mysqli_fetch_assoc($this->res);
		}


		public function fetchAll(){ // RETORNA ARRAY CON FILAS
			$aux = array();
			while($fila = $this->fetch()) $aux[] = $fila;
			return $aux;
		}

		public function numRows() {
			return mysqli_num_rows($this->res);
		}


		public function escape ($str){
			if (!$this->cn) $this->connect();
			return mysqli_escape_string($this->cn, $str); 
		}


		public function escapeWildCards ($str){
			$str = str_replace ('%', '\%', $str);
			$str = str_replace('_', '\_', $str);
			return $str;
		}

		public function insertId(){
			return mysqli_insert_id($this->cn);
		}

	}
