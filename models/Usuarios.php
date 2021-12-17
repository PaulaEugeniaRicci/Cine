<?php

// ../models/Usuarios.php

class Usuarios extends Model {

  public function validarSesion($email, $password) {
    
    $email = $this->db->escape($email);
    $email = str_replace("%", "\%", $email);
    $email = str_replace("", "\\", $email);

    $password = $this->db->escape($password);
    $password = sha1($password);


    $this->db->query("SELECT *
                      FROM usuarios
                      WHERE email like '$email' AND
                      password like '$password'");
    if($this->db->numRows() != 1) return false;

    return true;
  }

  //RETORNAR TODAS LAS FILAS
    public function getTodos(){
      $this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, u.rol
                FROM empleados e
                JOIN usuarios u ON e.id_empleado = u.id_empleado");
      return $this->db->fetchAll();
    }

    //BUSCAR POR ID
    public function getUsuarioById($id){

      //Validacion
      if(!ctype_digit($id)) throw new ExcepcionUsuario("Error en el ID del usuario.");
      if($id < 1) throw new ExcepcionUsuario("Error en el ID del usuario.");
      //
      $this->db->query("SELECT e.id_empleado, e.nombre, e.apellido, u.rol, u.email
                FROM empleados e
                JOIN usuarios u ON e.id_empleado = u.id_empleado 
                WHERE u.id_empleado = $id");
      return $this->db->fetchAll();
    }

    //ALTAS
    public function cargarUsuarios($email, $password, $rol, $usuario){

      //VALIDACIONES
      $email = trim($email);
      $password = trim($password);
      $rol = trim ($rol);

      $rol = $this->db->escape($rol);
      $rol = $this->db->escapeWildCards($rol);

      $email = $this->db->escape($email);
      $email = str_replace("%", "\%", $email);
      $email = str_replace("", "\\", $email);

      $password = $this->db->escape($password);
      $password = sha1($password);
     
      if(!ctype_digit($usuario)) throw new ExcepcionUsuario("Error: la identificacion de usuario debe ser numerica.");


      //Evitar cargar el mismo user de nuevo
      $this->db->query("SELECT * FROM usuarios WHERE id_empleado = $usuario");
      if($this->db->numRows()>=1) throw new ExcepcionUsuario("Error: ya existe un usuario para ese empleado.");
      
      //INSERT
      $this->db->query("INSERT INTO usuarios (email, password, rol, id_empleado) VALUES ('$email', '$password', '$rol', $usuario); ");
    }

    //MODIFICACIONES
    public function modificarUsuarios($email, $password, $rol, $usuario){

      //VALIDACIONES
      $email = trim($email);
      $password = trim($password);
      $rol = trim ($rol);

      $rol = $this->db->escape($rol);
      $rol = $this->db->escapeWildCards($rol);

      $email = $this->db->escape($email);
      $email = str_replace("%", "\%", $email);
      $email = str_replace("", "\\", $email);

      $password = $this->db->escape($password);
      $password = sha1($password);
     
      
      //VALIDACIONES parte 2 - Id
      if(!ctype_digit($usuario)) throw new ExcepcionUsuario("Error: la identificacion de usuario debe ser numerica.");

      if($usuario < 1) throw new ExcepcionUsuario("Error en la identificacion.");


      //UPDATE
       $this->db->query("UPDATE usuarios SET email = '$email', password = '$password', rol= '$rol' WHERE id_empleado = $usuario");    
           
    } 

}

class ExcepcionUsuario extends Exception {}
