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
        include_once("templates/header.php");
        include_once("templates/nav.php");
        accessLevel($securityLevel->deptAdm);        



        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = false;
            $thisDoc = docExist($_SESSION['editDoc']);
            $doc = $_FILES['Documento']['tmp_name'];

            if($_FILES['Documento']['size'] = 0){
                $doc = false;
            }
            $savedArchiveID = editArchive($_SESSION['editDoc'], $_POST['NombreDocumento'], $_POST['NumeroRevision'],$_FILES['Documento']['tmp_name'], $_POST['ElaboradoPor'], $_POST['RevisadoPor'], $_POST['AprobadoPor'], $_POST['VistoPor']);
            if($savedArchiveID != ''){
                $valid = true;
            }

            if($valid){
                //$followers = getFollowers($_SESSION['uploadRevision']);
                //sendNoti($followers, $thisDoc['CodigoDocumento'], 1);
                editSol($_SESSION['UserID'], $_SESSION['editSol']);
                $_SESSION['success'] = true;
                header("location: editArchive.php");
            } else{
                $error = 'Hubo un problema procesando su solicitud, favor vuelva a intentarlo.';
            }
            
        }


        $thisDept = getDept($_SESSION['UserDept'])['NombreDepartamento'];

       
        if(isset($_SESSION['success'])){
            $success = "Documento modificado correctamente.";
        }

        if(isset($_GET['d']) and isset($_GET['s'])){
            $thisDoc = getArchive($_GET['d']);
            $thisSol = getSol($_GET['s']);
            if($thisDoc != false and $thisSol != false){
                if($thisSol['EstadoSolicitud'] == $solEstatus->Rechazado or $thisSol['EstadoSolicitud'] == $solEstatus->Rechazado){
                    header("location: solicitudes.php");
                }
                $_SESSION['editDoc'] = $_GET['d']; 
                $_SESSION['editSol'] = $_GET['s']; 
            }else{
                $error = "Este documento no existe en la base de datos.";
            }
        }else{
            header("location: solicitudes.php");
        }
        
        if(!isset($_GET['d']) or !isset($_GET['s']) or $thisDoc == false){
            unset($_SESSION['editDoc']);
            unset($_SESSION['editSol']);
        }


    ?>

    <section class=''>

        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">

                    <div class="col m12">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">
                                Editar documento
                            </h4>
                            <div class="pdfBody white z-depth-3 center-align">
                                <form class="" action="" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="NombreDocumento" name="NombreDocumento" value="<?php echo $thisDoc['NombreDocumento'] ?>" type="text" class="validate[required]">
                                            <label for="NombreDocumento">Nombre del documento:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="CodigoDocumento" value="<?php echo $thisDoc['CodigoDocumento'] ?>" disabled name="CodigoDocumento" type="text" class="validate[required]">
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
                                                            if($u['IDUsuario'] == $thisDoc['ElaboradoPor'] ){
                                                                echo "<option selected value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }else{
                                                                echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }
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
                                                            if($u['IDUsuario'] == $thisDoc['RevisadoPor'] ){
                                                                echo "<option selected value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }else{
                                                                echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }
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
                                                            if($u['IDUsuario'] == $thisDoc['AprobadoPor'] ){
                                                                echo "<option selected value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }else{
                                                                echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }
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
                                                            if($u['IDUsuario'] == $thisDoc['VistoPor'] ){
                                                                echo "<option selected value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }else{
                                                                echo "<option value='".$u['IDUsuario']."'>".$u['Nombres']."</option>";
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="VistoPor">Visto por:</label>
                                        </div>
                                    </div>
                                    
                                    <!--
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
                                            <input id="NumeroRevision" name="NumeroRevision" value="<?php echo $thisDoc['NumeroRevision'] ?>" type="text" class="validate[required]">
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
                                            <input class="file-path" type="text">
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