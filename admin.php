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
        
        accessLevel($securityLevel->deptAdm);
    ?>


    <section class=''>
        <div class="container">
            <div class="row">
                    <div class="col m12">
                        <div>
                            <h4 class="title1 green2-text" style="margin-left: 0px">Menú administrativo</h4>
                            <div class="pdfBody white z-depth-3">
                                <div class="row">
                                    <div class="col m6 s12">
                                        <h4 class="title2 red2-text">Administración de documentos</h4>
                                        <div class="collection">
                                            <a href="configDocs.php" class="collection-item green2-text">Documentos</a>
                                        </div>
                                        <div class="collection">
                                            <a href="solicitudes.php" class="collection-item green2-text">Administración de solicitudes</a>
                                        </div>
                                    </div>
                                    <?php if($_SESSION['UserLevel'] >= $securityLevel->Admin) :?>
                                    <div class="col m6 s12">
                                        <h4 class="title2 red2-text">Administración general</h4>
                                        <div class="collection">
                                            <a href="configUser.php" class="collection-item green2-text">Usuarios</a>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
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