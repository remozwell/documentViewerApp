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
    if(isset($_GET['b'])){
        $doc = getArchive($_GET['b']);
        $_SESSION['CodigoDocumento'] = $doc['CodigoDocumento'];
    } else if(isset($_SESSION['CodigoDocumento'])){
        $doc = getUptArchive($_SESSION['CodigoDocumento']);
    }

    if(isset($_SESSION['CodigoDocumento']) && isset($_SESSION['UserID'])){
        //$doc = getArchive($_GET['b']);
        readNoti($_SESSION['CodigoDocumento'], $_SESSION['UserID'], 2);
    }
 
    include_once("templates/header.php");
    include_once("templates/nav.php");
    
    accessLevel($securityLevel->User);

    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        saveComment($doc['IDDocumento'], $_SESSION['UserID'], $_POST['newComentario']);
        $followers = getAdmins($doc['IDDepartamento']);
        sendNoti($followers, $doc['CodigoDocumento'], 2);
        $_SESSION['success'] = true;
        header("location: comentarios.php");
    }

    if(isset($_SESSION['success'])){
        $success = "Comentario enviado exitosamente.";
    }

    ?>

       

    <section class=''>
        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col m8">
                    <h4 class="title1 green2-text" style="margin-left: 0px">
                        Comentarios respecto a este documento
                    </h4>
                    <div class="comentarios white z-depth-3">
                        
                            <?php
                            if(($_SESSION['UserLevel'] >= $securityLevel->deptAdm && $_SESSION['UserDept'] == $doc['IDDepartamento']) || $_SESSION['UserLevel'] >= $securityLevel->Admin){
                                echo '<div id="com-history">';
                                $com = getComments($doc['IDDocumento']);
                                if(mysqli_num_rows($com) > 0){
                                    foreach($com as $c){
                                        echo '<div class="com-container">';
                                            echo '<h5 class="com-user green2-text">'.getUser($c['IDUsuario'])['Nombres'].'</h5>';
                                            echo '<div class="com-body">';
                                                echo nl2br($c['Comentario']);
                                            echo '</div>';
                                            echo '<div class="com-date right-align">';
                                                echo '<a href="mailto:'.getUser($c['IDUsuario'])['Email'].'?subject='.getArchive($c['IDDocumento'])['NombreDocumento'].'&body=-Comentario:%0A'.$c['Comentario'].'%0A%0A-Respuesta:%0A">Responder</a>';
                                                echo '<h6>'.$c['FechaComentario'].'</h6>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                }else{
                                    echo '<p class="center-align" style="margin: 20px 0px;">Este documento no tiene comentarios por el momento</p>';
                                }
                                echo '</div>';

                            }

                            ?>
                        
                        <div>
                            <form class="" action="" method="post">
                                <div class="row">
                                    <div class="input-field col s12 ">
                                        <textarea name="newComentario" id="newComentario" style="min-height: 150px;"
                                            class="materialize-textarea validate[required]"></textarea>
                                        <label for="newComentario">Nuevo comentario:</label>
                                    </div>
                                </div>
                                <!--
                                <div class="row">
                                    <div class="input-field col s12 ">
                                        <p>
                                            <label>
                                                <input type="checkbox" />
                                                <span>Quiero recibir notificaciones acerca de cambios o actualizaciones de este documento</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>    
                                -->                            
                                <div class="row">
                                    <div class="input-field col s12 right-align">
                                        <button class="btn red2 waves-effect waves-light" type="submit"
                                            name="action">Enviar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col m4">
                    <div class="col s12 white z-depth-3" style="margin-bottom: 20px;">
                        <h4 class="title2 red2-text">Detalles</h4>
                        <div>
                            <p><b>Nombre del documento: </b><span id='detNombreDocumento'><?php echo $doc['NombreDocumento'] ?></span></p>
                            <p><b>Elaborado Por: </b><span id='detElaborado'><?php echo getUser($doc['ElaboradoPor'])['Nombres'] ?></span></p>
                            <p><b>Revisado Por: </b><span id='detRevisado'><?php echo getUser($doc['RevisadoPor'])['Nombres'] ?></span></p>
                            <p><b>Aprobado Por: </b><span id='detAprobado'><?php echo getUser($doc['AprobadoPor'])['Nombres'] ?></span></p>
                            <p><b>Visto Por: </b><span id='detVisto'><?php echo getUser($doc['VistoPor'])['Nombres'] ?></span></p>
                            <p><b>Codigo del documento: </b><span id='detCodigoDoc'><?php echo $doc['CodigoDocumento'] ?></span></p>
                            <p><b>Fecha de emision: </b><span id='detFechaEmision'><?php echo $doc['FechaEmision'] ?></span></p>
                            <p><b>Número de revision: </b><span id='detNoRevision'><?php echo $doc['NumeroRevision'] ?></span></p>
                            <p><b>Fecha de revision: </b><span id='detFechaRevision'><?php echo $doc['FechaRevision'] ?></span></p>
                            <p><b>Departamento: </b><span id='detDepartamento'><?php echo getDept($doc['IDDepartamento'])['NombreDepartamento'] ?></span></p>
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