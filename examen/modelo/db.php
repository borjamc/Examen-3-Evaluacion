<?php
/**
 * Permitir la conexion contra la base de datos
 */
class db
{
  //Atributos necesarios para la conexion
  private $host="localhost";
  private $user="root";
  private $pass="";
  private $db_name="clubcatarroja";
  //Conector
  private $conexion;
  //Propiedades para controlar errores
  private $error=false;
  private $error_msj="";
  function __construct()
  {
      $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
      if ($this->conexion->connect_errno) {
        $this->error=true;
        $this->error_msj="No se ha podido realizar la conexion a la bd. Revisar base de datos o parámetros";
      }
  }
  //Funcion para saber si hay error en la conexion
  function hayError(){
    return $this->error;
  }
  //Funcion que devuelve mensaje de error
  function msjError(){
    return $this->error_msj;
  }

  function insertarCarrera($carrera,$fecha,$tiempo){
    //Construimos la consulta
    $sql="INSERT INTO carrera (id, carrera, fecha, idusuario, tiempo)
          VALUES (NULL, '".$carrera."', '".$fecha."', 0, ".$tiempo.")";
    //Realizamos la consulta
    $resultado=$this->realizarConsulta($sql);
    if($resultado!=false){
      //Recogemos el ultimo usuario insertado
      $sql="SELECT * from carrera ORDER BY id DESC";
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


  public function insertarUsuario2($nombre,$apellidos,$usuario,$pass,$email,$rol){
    if ($this->error==false) {

    $insert_sql="INSERT INTO usuario (id, idCategoria, nombre, apellidos, usuario, pass, email, rol)
          VALUES (NULL, '".$nombre."', '".$apellidos."', '".$usuario."','".sha1($pass)."','".$email."', '".$rol."')";
    if (!$this->conexion->query($insert_sql)) {
      echo "Fallo en la creacion de la tabla: (" .$this->conexion->errno .") " . $this->conexion->error;
    }
    return true;
  }else{
    return null;
  }

  }

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

  function buscarUsuario($usuario){
    //Construimos la consulta
    $sql="SELECT * from usuario WHERE usuario='".$usuario."'";
    //Realizamos la consulta
    $resultado=$this->realizarConsulta($sql);
    if($resultado!=null){
      //Montamos la tabla de resultados
      $tabla=[];
      while($fila=$resultado->fetch_assoc()){
        $tabla[]=$fila;
      }
      return $tabla;
    }else{
      return null;
    }
  }
  function LoginUsuario($usuario){
    //Construimos la consulta
    $sql="SELECT * from usuario WHERE usuario='".$usuario."'";
    //Realizamos la consulta
    $resultado=$this->realizarConsulta($sql);
    if($resultado!=false){
      if($resultado!=false){
        return $resultado->fetch_assoc();
      }else{
        return null;
      }
    }else{
      return null;
    }
  }
  //Metodo para la realización de consultas a la bd
  public function realizarConsulta($consulta){
    if($this->error==false){
      $resultado = $this->conexion->query($consulta);
      return $resultado;
    }else{
      $this->error_msj="Imposible realizar la consulta: ".$consulta;
      return null;
    }
  }

  public function actualizarUsuario($usuario, $nombre, $apellidos, $roles)
    {
      $sql="UPDATE usuario SET nombre='" .$nombre ."', apellidos='" .$apellidos ."', rol='" .$roles ."' WHERE usuario='" .$usuario ."'";
      $actualizarperfil=$this->realizarConsulta($sql);
      if ($actualizarperfil=!false) {
        return true;
      }else {
        return false;
      }
    }
  function categoria(){
     //Construimos la consulta
     $sql="SELECT * from categoria";
     //Realizamos la consulta
     $resultado=$this->realizarConsulta($sql);
     if($resultado!=null){
       //Montamos la tabla de resultados
       $tabla=[];
       while($fila=$resultado->fetch_assoc()){
         $tabla[]=$fila;
       }
       return $tabla;
     }else{
       return null;
     }
   }
}
 ?>
