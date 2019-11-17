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


        if(isset($_GET['r'])){
            $doc = getUptArchive($_GET['r']);
            if(!moreThanDeptAdm($doc['IDDepartamento'])){
                header("location: sinacceso.php");
            }
            if(isset($doc)){
                $_SESSION['RevCodDoc'] = $doc['CodigoDocumento'];
            }else{
                unset($_SESSION['RevCodDoc']);
            } 
        }

        



    ?>


    <section class=''>
        <?php include_once('templates/alerts.php'); ?>
        <div class="container">
            <div class="row">
                <?php if(isset($_SESSION['RevCodDoc'])) : ?>

                <div class="col m12">
                    <h4 class="title1 green2-text" style="margin-left: 0px">Administración de documentos</h4>
                    <div class="pdfBody white z-depth-3">
                            <div class="row">
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
                                                    <th>Ver documento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $revs = getRevList($_SESSION['RevCodDoc']);
                                                $n = 0;
                                                foreach($revs as $r){
                                                    $n = $n + 1;
                                                    echo '<tr>';
                                                        echo '<td>'.$n.'</td>';
                                                        echo '<td>'.$r['NombreDocumento'].'</td>';
                                                        echo '<td>'.$r['CodigoDocumento'].'</td>';
                                                        echo '<td>'.getUser($r['ElaboradoPor'])['Nombres'].'</td>';
                                                        echo '<td>'.getUser($r['RevisadoPor'])['Nombres'].'</td>';
                                                        echo '<td>'.getUser($r['AprobadoPor'])['Nombres'].'</td>';
                                                        echo '<td>'.getUser($r['VistoPor'])['Nombres'].'</td>';
                                                        echo '<td>'.getDept($r['IDDepartamento'])['NombreDepartamento'].'</td>';
                                                        echo '<td>'.$r['NumeroRevision'].'</td>';
                                                        echo '<td>'.$r['FechaEmision'].'</td>';
                                                        echo '<td>'.$r['FechaRevision'].'</td>';
                                                        echo '<td><a class="btn red2" target="_blank" href="files/'.$r['IDDocumento'].'.pdf">Documento</a></td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                                        
                    </div>
                </div>

                <?php else : ?>
                
                <div class="col m12">
                    <div>
                        <h4 class="title1 green2-text" style="margin-left: 0px">
                            Documento inexistente
                        </h4>
                        <div class="pdfBody white z-depth-3 center-align">
                            <p style="font-size: 14pt;">El documento seleccionado no existe en la base de datos del sistema.</p>
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