<?php

include 'db.php';

class Usuario extends db
{
  function insertarUsuario($nombre,$apellidos,$usuario,$pass,$email,$rol){
    //Construimos la consulta
    $sql="INSERT INTO usuario (id, idCategoria, nombre, apellidos, usuario, pass, email, rol)
          VALUES (NULL, '".$nombre."', '".$apellidos."', '".$usuario."','".sha1($pass)."','".$email."', '".$rol."')";
    //Realizamos la consulta
    $resultado=$this->realizarConsulta($sql);
    if($resultado!=false){
      //Recogemos el ultimo usuario insertado
      $sql="SELECT * from usuario ORDER BY id DESC";
      //Realizamos la consulta
      $resultado=$this->realizarConsulta($sql);
      if($resultado!=false){
        return $resultado->fetch_assoc();
      }else{
        return null;
      }
    }else{
      return null;
    }
  }
}








 ?>
