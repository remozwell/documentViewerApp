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


        if(isset($_SESSION['success'])){
            $success = "Documento subido correctamente.";
        }

    ?>


    <section class=''>
        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col m12">
                    <h4 class="title1 green2-text" style="margin-left: 0px">Administración de documentos</h4>
                    <div class="pdfBody white z-depth-3">
                            <div class="row">
                                <div class="col s12">
                                    <a class="btn exBtn green2" href="uploadArchive.php">Subir documento</a>
                                    <div class="clearfix">
                                        <br>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <h4 class="title2 red2-text">Lista de documentos</h4>
                                    <div class="table-container">
                                        <table class="striped highlight ">
                                            <thead>
                                                <tr>
                                                    <th>Ref.</th>
                                                    <th>Nombre Documento</th>
                                                    <th>Codigo del documento</th>
                                                    <th>Elaborado por</th>
                                                    <th>Revisado por</th>
                                                    <th>Aprobado por</th>
                                                    <th>Visto por</th>
                                                    <th>Departamento</th>
                                                    <th>Revisión</th>
                                                    <th>Fecha de creación</th>
                                                    <th>Fecha ultima revisión</th>
                                                    <th>Ver revisiones</th>
                                                    <th>Subir nueva revision</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $docs = getDocList();
                                                $n = 0;
                                                foreach($docs as $d){
                                                    if(moreThanDeptAdm($d['IDDepartamento'])){
                                                        $n = $n + 1;
                                                        echo '<tr>';
                                                            echo '<td>'.$n.'</td>';
                                                            echo '<td>'.$d['NombreDocumento'].'</td>';
                                                            echo '<td>'.$d['CodigoDocumento'].'</td>';
                                                            echo '<td>'.getUser($d['ElaboradoPor'])['Nombres'].'</td>';
                                                            echo '<td>'.getUser($d['RevisadoPor'])['Nombres'].'</td>';
                                                            echo '<td>'.getUser($d['AprobadoPor'])['Nombres'].'</td>';
                                                            echo '<td>'.getUser($d['VistoPor'])['Nombres'].'</td>';
                                                            echo '<td>'.getDept($d['IDDepartamento'])['NombreDepartamento'].'</td>';
                                                            echo '<td>'.$d['NumeroRevision'].'</td>';
                                                            echo '<td>'.$d['FechaEmision'].'</td>';
                                                            echo '<td>'.$d['FechaRevision'].'</td>';
                                                            echo '<td><a class="btn red2" href="revisiones.php?r='.$d['CodigoDocumento'].'">ver</a></td>';
                                                            echo '<td><a class="btn red2" href="uploadArchive.php?d='.$d['CodigoDocumento'].'">Subir</a></td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            </table>
                                    </div>
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