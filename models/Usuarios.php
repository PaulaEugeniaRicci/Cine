<?php

// ../models/Usuarios.php

class Usuarios extends Model {

  public function validarSesion($email, $password) {
  
    $email = $this->db->escape($email);
    $email = str_replace("%", "\%", $email);
    $email = str_replace("", "\\", $email);

    $password = $this->db->escape($password);
   // $password = sha1($password);


    $this->db->query("SELECT *
                      FROM usuarios
                      WHERE email like '$email' AND
                      password like '$password'");
    if($this->db->numRows() != 1) return false;

    return true;
  }

}