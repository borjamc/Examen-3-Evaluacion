<?php
include 'seguridad/Seguridad.php';
$sesion=new Seguridad();
if (isset($_SESSION['usuario'])==false) {
  header('Location: index.php');
}else {

 ?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Club Catarroja</title>
    <link rel="stylesheet" href="./css/estilos.css">
  </head>
  <body>
    <!--MENU-->
    <div class="menu">
      <nav>
        <ul>
          <li><a href="index.html"><img src="./img/logo.png" alt=""></a></li>
          <li><a href="nuevacarrera.php">Nueva Carrera</a></li>
          <li><a href="listarcarreras.php">Listar Carreras</a></li>
          <li><a href="registro.php">Registrar usuario</a></li>
        </ul>
      </nav>
    </div>
    <!--MENU-->
    <!--MENU-->
    <div class="contenido">
      <form method="post" action="nuevacarrera.php">

        <label>Carrera</label><br>
        <input type="text" name="carrera"><br><br>

        <label>Fecha</label><br>
        <input type="text" name="fecha"><br><br>

        <label>Tiempo</label><br>
        <input type="text" name="tiempo"><br><br>

        <input type="hidden" name="accion" value="insert">

        <input type="submit" value="Registrar"><br><br>
      </form>
    </div>
    <?php

    include 'modelo/carreras.php';

    if(isset($_POST["accion"])){

      $carrera=new db();

      if($_POST["accion"]=="insert"){
        if ($_POST["carrera"]!=null && $_POST["fecha"]!=null && $_POST["tiempo"]!=null) {
          $carreraReg=$carrera->insertarCarrera($_POST["carrera"],$_POST["fecha"],
                                 $_POST["tiempo"]);
          if($carreraReg!=null)
          {
            echo "<h2>Carrera registrada</h2></br>";
          }else{
            echo "<h2>La carrera no ha sido insertado. Revisa los datos</h2></br>";
          }
      }else {
        echo "ERROR: Introduce todos los campos";
      }
    }
  }
}
     ?>
  </body>
</html>
