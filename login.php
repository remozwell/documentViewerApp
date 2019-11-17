<!DOCTYPE html>
<html lang='es'>

<head>
    <title> Sistema de Gestion de la Calidad - Programa de Medicamentos Esenciales </title>
    <meta charset="UTF-8">
    <?php include_once "templates/styles.php"; ?>
</head>

<body class="grey lighten-3">
<?php
    include_once("templates/globalIncludes.php");
   include_once("conection/conn.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['Usuario']);
      $mypassword = mysqli_real_escape_string($db,$_POST['Contrasena']); 
      $encryptPassword = md5($mypassword);
      //echo $encryptPassword;
      // Check connection
      if(!$db){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $sql = "SELECT * FROM usuarios WHERE NombreUsuario = '$myusername' and Contrasena = '$encryptPassword'";
      
      $result = mysqli_query($db, $sql);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['Estado'];

      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1){
        if($active){
            //session_register("myusername");
            $_SESSION['login_user'] = $myusername;
            $_SESSION['UserID'] = $row['IDUsuario'];
            $_SESSION['UserLevel'] = $row['NivelUsuario'];
            $_SESSION['UserDept'] = $row['IDDepartamento'];
            header("location: index.php");
            }else {
                $error = "Usuario inactivo, favor comunicarse con el administrador.";
            }
        }else {
         $error = "Tu nombre de usuario o contraseña son incorrectos.";
      }
   }
?>
    
    <header class='white'>
        <div class="container">
            <div class="row">
                <div class="col m6 s12">
                    <img src="images/logo.png" class="logo" />
                </div>
                <div class="col m6 s12 right-align">
                    
                </div>
            </div>
        </div>
    </header>
   
  
    <?php include_once("templates/nav.php") ?>

    

    <section class=''>
        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="" style="padding-top: 25px;" >
                <h5 class="title1 green2-text center-align"> Inicia Sesion para tener acceso a todas las funcionalidades </h5>

                <div class="row" style="padding-top: 15px; padding-bottom: 50px;">
                    <div class="white z-depth-3 col m6 s12 offset-m3" >
                        <form class="" action="" method="post">
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input id="Usuario" name="Usuario" type="text" class="validate[required]">
                                    <label for="Usuario">Nombre de usuario:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="Contrasena" name="Contrasena" type="password" class="validate[required]">
                                    <label for="Contrasena">contraseña</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 right-align">
                                    <button class="btn red2 waves-effect waves-light" style="width: 100%;" type="submit" name="action">Iniciar sesion
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <p style="margin-bottom: 0px;"><b>Nota:</b> Los datos accesos al sistema son los mismos de acceso al equipo</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <footer class="page-footer grey darken-2" >
        <div class="container">
            <div class="row" >
                <div class="col  s12">
                    <!--<h5 class="white-text">Promesecal</h5>
                    <img src="images/logo-wb.png" class="logoF">-->
                    <h5>Sistema de Gestion de Calidad - Departamento de Planificación y Desarrollo</h5>
                    <p class="grey-text text-lighten-4"></p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                ©
                <!--<?php echo date("Y");?>-->2019 Copyright
            </div>
        </div>
    </footer>

    <?php include_once('templates/jsFunctions.php'); ?>
</body>

</html>