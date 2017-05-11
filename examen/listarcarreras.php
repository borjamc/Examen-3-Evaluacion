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
      <?php

      include 'modelo/carreras.php';
        //Genereamos un nuevo objeto
        $carrera=new Carrera();

        $listacarrera=$carrera->listarCarrera();
          echo "<table border='1'>";
        foreach ($listacarrera as $fila) {
          echo "<td>";
            echo "<tr>";
          echo "Carrera: ".$fila["carrera"]."<br>";
            echo "</tr>";
            echo "<tr>";
          echo "Fecha: ".$fila["fecha"]."<br>";
            echo "</tr>";
}
        echo "</table>";

}


          ?>

    </div>
  </body>
</html>
