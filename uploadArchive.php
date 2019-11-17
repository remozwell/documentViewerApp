<!DOCTYPE html>
<html lang='es'>

<head>
    <title> Sistema de Gestion de la Calidad - Programa de Medicamentos Esenciales </title>
    <meta charset="UTF-8">
    <?php include_once "templates/styles.php"; ?>
</head>

<body class="grey lighten-3">

    <?php 
        include_once("conection/session.php");
        include_once("templates/globalIncludes.php");
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_SESSION['UserLevel'] == $securityLevel->Admin ){
                $disponibilidad = 1;
            }else{
                $disponibilidad = 0;
            }

            $valid = false;
            $savedArchiveID;
            if(isset($_SESSION['uploadRevision'])){
                $thisDoc = docExist($_SESSION['uploadRevision']);
                $savedArchiveID = saveArchive($_POST['NombreDocumento'], $thisDoc['IDDepartamento'],$_SESSION['uploadRevision'],$disponibilidad,$_POST['NumeroRevision'],$_FILES['Documento']['tmp_name'], $thisDoc['FechaEmision'], $_POST['ElaboradoPor'], $_POST['RevisadoPor'], $_POST['AprobadoPor'], $_POST['VistoPor']);
                $valid = true;
            }else{
                $thisDoc = docExist($_POST['CodigoDocumento']);
                if($_SESSION['UserLevel'] >= $securityLevel->Admin){
                    $dept = $_POST['Departamento'];
                }else{
                    $dept = $_SESSION['UserDept'];
                }
                if($thisDoc == false){
                    $fecha = date_format(date_create(),"Y-m-d"); 
                    $savedArchiveID = saveArchive($_POST['NombreDocumento'], $dept,$_POST['CodigoDocumento'],$disponibilidad,$_POST['NumeroRevision'],$_FILES['Documento']['tmp_name'], $fecha, $_POST['ElaboradoPor'], $_POST['RevisadoPor'], $_POST['AprobadoPor'], $_POST['VistoPor']);
                    $valid = true;
                }else{
                    $error = 'El codigo de documento "'.$_POST['CodigoDocumento'].'" ya existe en la base de datos.';
                }
            }

            if($valid){
                //$followers = getFollowers($_SESSION['uploadRevision']);
                //sendNoti($followers, $thisDoc['CodigoDocumento'], 1);
                if($disponibilidad != 1){
                    saveSol($savedArchiveID, $_SESSION['UserID']);
                }
                $_SESSION['success'] = true;
                header("location: configDocs.php");
            } else{
                $error = 'Hubo un problema procesando su solicitud, favor vuelva a intentarlo.';
            }
        }

        include_once("templates/header.php");
        include_once("templates/nav.php");
        accessLevel($securityLevel->deptAdm);        

        $thisDept = getDept($_SESSION['UserDept'])['NombreDepartamento'];

       
        if(isset($_SESSION['success'])){
            $success = "Documento subido correctamente.";
        }

        if(isset($_GET['d'])){
            $thisDoc = docExist($_GET['d']);
            if($thisDoc != false){
                $_SESSION['uploadRevision'] = $_GET['d']; 
            }else{
                $error = "Este documento no existe en la base de datos, pero puede crear uno nuevo.";
            }
        }
        
        if(!isset($_GET['d']) or $thisDoc == false){
            unset($_SESSION['uploadRevision']);
        }


    ?>

    <section class=''>

        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">

                    <div class="col m12">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">
                                Subida de documentos
                            </h4>
                            <div class="pdfBody white z-depth-3 center-align">
                                <form class="" action="" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="NombreDocumento" name="NombreDocumento" type="text" class="validate[required]">
                                            <label for="NombreDocumento">Nombre del documento:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="CodigoDocumento" <?php echo isset($_SESSION['uploadRevision']) ? 'disabled value="'.$_SESSION['uploadRevision'].'"' : "" ?> name="CodigoDocumento" type="text" class="validate[required]">
                                            <label for="CodigoDocumento">Codigo del documento:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="ElaboradoPor" name="ElaboradoPor"  class="validate[required]">
                                                <option value=''>Selecciona un quien lo elaboro...</option>
                                                <?php
                                                    $users = getUserList();
                                                    foreach ($users as $u) {
                                                        if(moreThanDeptAdm($u['IDDepartamento'])){
                                                            echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="ElaboradoPor">Elaborado por:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="RevisadoPor" name="RevisadoPor"  class="validate[required]">
                                                <option value=''>Selecciona un quien lo reviso...</option>
                                                <?php
                                                    foreach ($users as $u) {
                                                        if(moreThanDeptAdm($u['IDDepartamento'])){
                                                            echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="RevisadoPor">Revisado por:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="AprobadoPor" name="AprobadoPor"  class="validate[required]">
                                                <option value=''>Selecciona un quien lo aprobo...</option>
                                                <?php
                                                    foreach ($users as $u) {
                                                        if(moreThanDeptAdm($u['IDDepartamento'])){
                                                            echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="AprobadoPor">Aprobado por:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="VistoPor" name="VistoPor"  class="">
                                                <option value=''>Selecciona un quien lo vio...</option>
                                                <?php
                                                    foreach ($users as $u) {
                                                        if(moreThanDeptAdm($u['IDDepartamento'])){
                                                            echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="VistoPor">Visto por:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <?php if($_SESSION['UserLevel'] >= $securityLevel->Admin and !isset($_SESSION['uploadRevision'])) : ?>
                                            <select id="Departamento" name="Departamento"  class="validate[required]">
                                                <option value=''>Selecciona un departamento...</option>
                                                <?php
                                                    $depts = getDeptList();
                                                    foreach ($depts as $d) {
                                                        echo "<option value='".$d['IDDepartamento']."'>".$d['NombreDepartamento']."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <?php else : ?>
                                            <input type="text" value="<?php echo $thisDept; ?>" disabled="true"/>
                                            <?php endif ?>
                                                
                                            <label for="Departamento">Departamento:</label>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="NivelSeguridad" name="NivelSeguridad"  class="validate">
                                                <option value=''>Seleccione un nivel de segurida...</option>
                                                <option value='0'>Todos</option>
                                                <option value='1'>Solo usuarios</option>
                                                <option value='2'>Gestores de contenido</option>
                                                <option value='3'>Administradores</option>
                                            </select>
                                            <label for="NivelSeguridad">NivelSeguridad</label>
                                        </div>
                                    </div>
                                    -->
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="NumeroRevision" name="NumeroRevision" type="text" class="validate[required]">
                                            <label for="NumeroRevision">Número de revisión:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="file-field input-field col s12 ">
                                        <div class="btn">
                                            <span>Documento</span>
                                            <input type="file" name="Documento" class="">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate[required]" type="text">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 right-align">
                                            <button class="btn red2 waves-effect waves-light" style="width: 100%;" type="submit" name="action">Subir documento
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

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