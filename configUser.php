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
        include_once("templates/header.php");
        include_once("templates/nav.php");
        
        accessLevel($securityLevel->Admin);

        $sessionType = 'list';
        if(isset($_GET['u'])){
           switch($_GET['u']){
                case '':
                    break;
                case 'newUser':
                    $sessionType = 'newUser';
                    break;
                default :
                    $sessionType = 'updateUser';
                    break;
           }
        }

        if($sessionType == 'updateUser'){
            $_SESSION['updateUser'] = $_GET['u'];
            $user = getUser($_SESSION['updateUser']);
        }

        if($sessionType == 'newUser'){
            $_SESSION['updateUser'] = '';
        }

        if($_SERVER["REQUEST_METHOD"] == "POST" and $_POST['NivelUsuario'] <= $_SESSION['UserLevel']) {
            if($_SESSION['updateUser']){
               updateUser(
                    $_SESSION['updateUser'],
                    $_POST['NivelUsuario'],
                    $_POST['Estado']
               );

               if($_SESSION['updateUser'] == $_SESSION['UserID']){
                $_SESSION['UserLevel'] = $_POST['NivelUsuario'];
               }
                
            }else{
                if($_POST['Contrasena'] == $_POST['ReContrasena']){
                    if(!checkUser($_POST['NombreUsuario'])){
                        saveUser(
                            $_POST['NombreUsuario'],
                            md5($_POST['Contrasena']),
                            $_POST['Nombres'],
                            $_POST['Apellidos'],
                            $_POST['NivelUsuario'],
                            $_POST['Departamento'],
                            $_POST['Email']
                        );
                    }else{
                        $error = "El nombre de usuario ya existe";
                    }
                }else{
                    $error = "La contraseña y la repetición de la misma deben ser iguales";
                }
            }
            if(!isset($error)){
                $_SESSION['success'] = true;
                header("location: configUser.php");
            }
        }

        if(isset($_SESSION['success'])){
            $success = "Los cambios se han guardado exitosamente";
        }

    ?>


    <section class=''>
        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col m12">
                    <h4 class="title1 green2-text" style="margin-left: 0px">Configuracion de usuarios</h4>
                    <div class="pdfBody white z-depth-3">
                        <?php if($sessionType == 'newUser' or $sessionType == 'updateUser') : ?>
                            <?php 
                                if($sessionType == 'updateUser'){
                                    echo '<h4 class="title2 red2-text">Editar usuario</h4>';
                                } else if($sessionType == 'newUser'){
                                    echo '<h4 class="title2 red2-text">Usuario nuevo</h4>';
                                }
                            ?>
                            
                            <form class="row" action="" enctype="multipart/form-data" method="post">
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="NombreUsuario" 
                                                value="<?php echo isset($user['NombreUsuario']) ? $user['NombreUsuario'] : ""  ?>" 
                                                <?php echo $sessionType == 'updateUser' ? 'disabled' : ''  ?>
                                                name="NombreUsuario" type="text" class="validate[required]">
                                            <label for="NombreUsuario">Nombre de usuario:</label>
                                        </div>
                                    </div>
                                </div>

                                <?php if($sessionType == 'newUser') : ?>
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="Contrasena" value="" name="Contrasena" type="password" class="validate[required]">
                                            <label for="Contrasena">Contraseña:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="ReContrasena" value="" name="ReContrasena" type="password" class="validate[required]">
                                            <label for="ReContrasena">Repita contraseña:</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="Nombres" 
                                                value="<?php echo isset($user['Nombres']) ? $user['Nombres'] : ""  ?>" 
                                                name="Nombres" type="text" class="validate[required]">
                                            <label for="Nombres">Nombres:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="Apellidos" 
                                                value="<?php echo isset($user['Apellidos']) ? $user['Apellidos'] : ""  ?>" 
                                                name="Apellidos" type="text" class="validate[required]">
                                            <label for="Apellidos">Apellidos:</label>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="FechaNacimiento" 
                                                value="<?php echo isset($user['FechaNacimiento']) ? $user['FechaNacimiento'] : ""  ?>" 
                                                name="FechaNacimiento" type="text" class="datepicker validate[required]">
                                            <label for="FechaNacimiento">Fecha de nacimiento:</label>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <?php if($_SESSION['UserLevel'] >= $securityLevel->Admin) : ?>
                                            <select id="Departamento" name="Departamento"  class="validate[required]">
                                                <option value=''>Selecciona un departamento...</option>
                                                <?php
                                                    $depts = getDeptList();
                                                    foreach ($depts as $d) {
                                                        $selected = "";
                                                        if(isset($user['IDDepartamento'])){
                                                            if($user['IDDepartamento'] == $d['IDDepartamento']){
                                                                $selected = "selected";
                                                            }
                                                        }
                                                        echo "<option ".$selected." value='".$d['IDDepartamento']."'>".$d['NombreDepartamento']."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <?php else : ?>
                                            <input type="text" value="<?php echo getDept($_SESSION['UserDept'])['NombreDepartamento']; ?>" disabled="true"/>
                                            <?php endif ?>
                                            <label for="Departamento">Departamento</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="Email" 
                                                value="<?php echo isset($user['Email']) ? $user['Email'] : ""  ?>" 
                                                name="Email" type="text" class="validate[required]">
                                            <label for="Email">Email:</label>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="Telefono" 
                                                value="<?php echo isset($user['Telefono']) ? $user['Telefono'] : ""  ?>" 
                                                name="Telefono" type="text" class="validate[required]">
                                            <label for="Telefono">Teléfono:</label>
                                        </div>
                                    </div>
                                </div>-->
                                <?php endif ?>

                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="NivelUsuario" name="NivelUsuario"  class="validate">
                                                <?php
                                                    $nvl = 0;
                                                    if(isset($user['NivelUsuario'])){
                                                        $nvl = $user['NivelUsuario'];
                                                    }
                                                ?>
                                                <option value='1' <?php echo $nvl == 1 ? "selected" : "" ?> >Usuario</option>
                                                <option value='2' <?php echo $nvl == 2 ? "selected" : "" ?> >Administrador del departamento</option>
                                                <?php if($_SESSION['UserLevel'] >= $securityLevel->Admin) : ?>
                                                <option value='3' <?php echo $nvl == 3 ? "selected" : "" ?> >Administrador</option>
                                                <?php endif ?>
                                            </select>
                                            <label for="NivelUsuario">Tipo de usuario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php if($sessionType == 'updateUser') : ?>
                                <div class="col m6 s12">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <select id="Estado" name="Estado"  class="validate">
                                                <option value='0'>Inactivo</option>
                                                <option value='1' <?php echo $user['Estado'] == 1 ? "selected" : "" ?>>Activo</option>
                                            </select>
                                            <label for="Estado">Estado del usuario</label>
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>


                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12 right-align">
                                            <button class="btn red2 waves-effect waves-light" style="width: 100%;" type="submit" name="action">
                                                <?php 
                                                    if($sessionType == 'updateUser'){
                                                        echo 'Actualizar información del usuario';
                                                    } else if($sessionType == 'newUser'){
                                                        echo 'Agregar nuevo usuario';
                                                    }
                                                ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php else : ?>
                            <div class="row">
                                <div class="col s12">
                                    <a class="btn exBtn green2" href="configUser.php?u=newUser">Agregar usuario</a>
                                    <div class="clearfix">
                                        <br>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <h4 class="title2 red2-text">Lista de usuarios</h4>
                                    <div class="table-container">
                                        <table class="striped highlight ">
                                            <thead>
                                                <tr>
                                                    <th>Ref.</th>
                                                    <th>Usuario</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Tipo</th>
                                                    <th>Departamento</th>
                                                    <!--<th>Fecha de nacimiento</th>-->
                                                    <th>Email</th>
                                                    <!--<th>Telefono</th>-->
                                                    <th>Estado</th>
                                                    <th>Editar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $users = getUserList();
                                                $n = 0;
                                                foreach($users as $u){
                                                    if(moreThanDeptAdm($u['IDDepartamento']) and $u['NivelUsuario'] <= $_SESSION['UserLevel']){
                                                        $n = $n + 1;
                                                        echo '<tr>';
                                                            echo '<td>'.$n.'</td>';
                                                            echo '<td>'.$u['NombreUsuario'].'</td>';
                                                            echo '<td>'.$u['Nombres'].'</td>';
                                                            echo '<td>'.$u['Apellidos'].'</td>';
                                                            echo '<td>'.getSecLevel($u['NivelUsuario']).'</td>';
                                                            echo '<td>'.$u['NombreDepartamento'].'</td>';
                                                            //echo '<td>'.$u['FechaNacimiento'].'</td>';
                                                            echo '<td>'.$u['Email'].'</td>';
                                                            //echo '<td>'.$u['Telefono'].'</td>';
                                                            echo '<td><div class="st '.getUserState($u['Estado']).'">'.getUserState($u['Estado']).'</div></td>';
                                                            echo '<td><a class="btn red2" href="configUser.php?u='.$u['IDUsuario'].'">Editar</a></td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                                        
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="page-footer grey darken-2">
        <div class="container">
            <div class="row">
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