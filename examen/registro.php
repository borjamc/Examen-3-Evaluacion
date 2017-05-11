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
          <li><a href="index.php"><img src="./img/logo.png" alt=""></a></li>
          <li><a href="nuevacarrera.php">Nueva Carrera</a></li>
          <li><a href="listarcarreras.php">Listar Carreras</a></li>
          <li><a href="registro.php">Registrar usuario</a></li>
        </ul>
      </nav>
    </div>
    <!--MENU-->
    <!--MENU-->
    <div class="contenido">
      <h2>Formulario de registro</h2>
      <form method="post" action="registro.php">

        <label>Nombre</label><br>
        <input type="text" name="nombre" ><br><br>

        <label>Apellidos</label><br>
        <input type="text" name="apellidos"><br><br>

        <label>Usuario</label><br>
        <input type="text" name="usuario"><br><br>

        <label>Contraseña</label><br>
        <input type="password" name="pass0"><br><br>

        <label>Repetir Contraseña</label><br>
        <input type="password" name="pass1"><br><br>

        <label>Email</label><br>
        <input type="text" name="email"><br><br>

        <label>Rol</label><br>
        <input type="text" name="rol"><br><br>

        <select class="" name="categoria">
          <?php

          include 'modelo/db.php';
          $user=new db();

          $categorias=$user->categoria();
          foreach ($categorias as $fila) {
            echo "<option value='".$fila['id']."' name='".$fila['id']."'>".$fila['categoria']."</option>";
          }
           ?>



        <input type="hidden" name="accion" value="registro">

        <input type="submit" value="Registrar"><br><br>
      </form>
    </div>
    <?php


    if(isset($_POST["accion"])){

      //Registro de usuario
      if($_POST["accion"]=="registro"){
        if ($_POST["usuario"]!=null && $_POST["nombre"]!=null && $_POST["apellidos"]!=null && $_POST["pass0"]!=null && $_POST["pass1"]!=null && $_POST["email"]!=null && $_POST["rol"]!=null) {
        if($_POST["pass0"]==$_POST["pass1"]){
          $usurioReg=$user->insertarUsuario($_POST["nombre"],$_POST["apellidos"], $_POST["usuario"],$_POST["pass0"],$_POST["email"],$_POST["rol"]);
          var_dump($user);
          if($usurioReg!=null)
          {
            echo "<h2>Usuario insertado</h2></br>";
          }else{
            //Usuario no insertado
            echo "<h2>El usuario no ha sido insertado. Revisa los datos</h2></br>";
          }
        }else{
          //Contraseñas diferentes
          echo "<h2>Las contraseñas no son iguales</h2></br>";
          echo "<a href=registro.php>Volver al formulario de registro</a>";
        }
      }else {
        echo "ERROR: Introduce todos los campos";
      }
      }
    }



     ?>
  </body>
</html>
