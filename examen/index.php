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
      <h2>Login</h2>
      <form method="post" action="index.php">
        <label>Usuario:</label><br>
        <input type="text" name="usuario"><br><br>

        <label>Contraseña</label><br>
        <input type="password" name="pass"><br><br>

        <input type="hidden" name="accion" value="login">

        <input type="submit" value="Login">
      </form>
    </div>
    <?php

    include 'seguridad/Seguridad.php';
    include 'modelo/db.php';

    //Si envia el campo oculto hace esto

    if(isset($_POST["accion"])){
      //Genereamos un nuevo objeto
      $seguridad=new Seguridad();
      $user=new db();

      if ($_POST["accion"]=="login") {
        if ($_POST["usuario"]!=null && $_POST["pass"])
        $usurioReg=$user->LoginUsuario($_POST["usuario"]);
        if($usurioReg!=null)
        {
          //Comparamos los passwords
          if($usurioReg["pass"]==($_POST["pass"])){
            echo "<h2>Registro correcto</h2></br>";
            $seguridad->addUsuario($usurioReg["usuario"]);
          }else{
            echo "<h2>ERROR: La contraseña no coincide</h2></br>";
            echo "<a href=index.php>Volver al formulario de login</a>";
          }
        }else{
          echo "<h2>ERROR: Usuario no encontrado</h2></br>";
          echo "<a href=registro.php>Registra tu usuario aqui</a>";
        }
      }
    }
     ?>









  </body>
</html>
