<?php

include 'db.php';

class Carrera extends db
{
    function insertarCarrera($carrera,$fecha,$tiempo){
      //Construimos la consulta
      $sql="INSERT INTO carrera (id, carrera, fecha, idusuario, tiempo)
            VALUES (NULL, '".$carrera."', '".$fecha."', ".$tiempo.")";
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

    function listarCarrera(){
      //Construimos la consulta
      $sql="SELECT * from carrera";
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
