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

        if(!isset($_GET['d'])){
            if(isset($_GET['b'])){
                $_SESSION['CodigoDocumento'] = getArchive($_GET['b'])['CodigoDocumento'];
            }
            if(isset($_SESSION['CodigoDocumento'])){
                $doc = getUptArchive($_SESSION['CodigoDocumento']);
            }
        } else{
            $doc = getArchive($_GET['d']);
        }

        if(isset($_SESSION['CodigoDocumento']) && isset($_SESSION['UserID'])){
            //$doc = getArchive($_GET['b']);
            readNoti($_SESSION['CodigoDocumento'], $_SESSION['UserID'], 1);
        }

        include_once("templates/header.php");
        include_once("templates/nav.php");
        


        if(isset($_GET['f'])){
            if($_GET['f'] == "flw"){
                addFollower($_SESSION['UserID'], $doc['CodigoDocumento']);
            }else if($_GET['f'] == "unFlw"){
                deleteFollower($_SESSION['UserID'], $doc['CodigoDocumento']);
            }
        }

        
    ?>


    <ul id="slide-out" class="sidenav collapsible">

        <?php
        
            $docs = getDocList();
            $depts = getDeptList();
            foreach($depts as $d){
                echo "<li>";
                echo "<div class='collapsible-header'>".$d['NombreDepartamento']."</div>";
                echo '<div class="collapsible-body">';
                echo '<ul>';
                foreach($docs as $do){
                    if($do['IDDepartamento'] == $d['IDDepartamento']){
                        echo "<li><a href=documentos.php?b=".$do['IDDocumento'].">".$do['NombreDocumento']."</a></li>";
                    }
                }
                echo '</ul>';
                echo "</div>";
                echo "</li>";
            }

        ?>
        <!--
        <li>
            <div class="collapsible-header">Dirección general</div>
            <div class="collapsible-body">
                <ul>
                    <li><a href="#">Archivo 1</a></li>
                    <li><a href="#">Archivo 2</a></li>
                </ul>
            </div>
        </li>
        -->
    </ul>

    <section class=''>
        <div class="container">
            <div class="row">
                <?php if(isset($doc)) : ?>
                    <div class="col m8">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">
                                <a href="#" data-target="slide-out" class="sidenav-trigger sidenav-title-trigger">
                                    <i class="material-icons green2-text">menu</i>
                                </a>
                                <?php echo $doc['NombreDocumento'] ?>
                            </h4>
                            <div class="pdfBody white z-depth-3">
                                <iframe src="files/<?php echo $doc['IDDocumento'] ?>.pdf"></iframe>
                            </div>

                        </div>
                    </div>
                    <div class="col m4">
                        <div class="col s12 white z-depth-3" style="margin-top: 42px; margin-bottom: 20px;">
                            <h4 class="title2 red2-text">Detalles</h4>
                            <div>
                                <!--<p><b>Nombre del documento: </b><span id='detNombreDocumento'></span></p>-->
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

                            <?php if(!isset($_GET['d'])): ?>
                                <div style="margin-top: 25px; justify-content;" >
                                    <p><b> <i> Comentarios con relación a este documento. </i></b></p> 
                                    <a class="waves-effect waves-light btn red2 " href="comentarios.php">Comentarios</a>
                                    <p></p>
                                </div>
                                <?php if(isset($_SESSION['login_user'])) : ?>
                                    <div style="margin-top: 25px; justify-content;" >
                                        <p><b> <i> Recibir notificaciones de seguimiento con relacion a este documento. </i></b></p>
                                        <?php
                                            $follow = isFollowing($_SESSION['UserID'], $doc['CodigoDocumento']);
                                            if($follow >= 1){
                                                echo '<a class="waves-effect waves-light btn red2 " href="documentos.php?f=unFlw">Dejar de seguir</a>';
                                            } else{
                                                echo '<a class="waves-effect waves-light btn red2 " href="documentos.php?f=flw">Seguir</a>';
                                            }
                                        ?>
                                        <p></p>
                                    </div>


                                    <?php if(moreThanDeptAdm($doc['IDDepartamento'])) : ?>
                                        
                                    <div style="margin-top: 25px; justify-content;" >
                                        <p><b> <i>Ver y subir las revisiones de este documento. </i></b></p> 
                                        <a class="waves-effect waves-light btn red2 " href="revisiones.php?r=<?php echo $doc['CodigoDocumento'] ?>">Revisiones</a>
                                        <p></p>
                                    </div>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                <?php elseif(isset($_GET['b'])) : ?>
                    <div class="col m12">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">
                                <a href="#" data-target="slide-out" class="sidenav-trigger sidenav-title-trigger">
                                    <i class="material-icons green2-text">menu</i>
                                </a>
                                <= seleccione aquí un documento
                            </h4>
                            <div class="pdfBody white z-depth-3 center-align">
                                <p style="font-size: 14pt;">El documento seleccionado no existe en la base de datos del sistema.<br> <b class="red2-text">Por favor</b>, seleccione otro documento de la lista.</p>
                            </div>

                        </div>
                    </div>
                <?php else : ?>
                    <div class="col m12">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">
                                <a href="#" data-target="slide-out" class="sidenav-trigger sidenav-title-trigger">
                                    <i class="material-icons green2-text">menu</i>
                                </a>
                                <= seleccione aquí un documento
                            </h4>
                            <div class="pdfBody white z-depth-3 center-align">
                                <p style="font-size: 14pt;"><b class="red2-text">Por favor</b>, seleccione un documento de la lista en el menú de arriba.</p>
                            </div>

                        </div>
                    </div>

                <?php endif ?>

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