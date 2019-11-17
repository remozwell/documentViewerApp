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


        if($_SERVER["REQUEST_METHOD"] == "POST") {
            changeSolState($_SESSION['UserID'], $_POST['IDSolicitud'], $_POST['Accion'], $_POST['newComentario']);
            if($_POST['Accion'] == $solEstatus->Aprobado){
                avlArchive($_POST['IDDocumento'], 1);
            }
            $_SESSION['success'] = true;
            header("location: solicitudes.php");
        }

        if(isset($_SESSION['success'])){
            $success = "Respuesta enviada correctamente.";
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
                                    <h4 class="title2 red2-text">Lista de solicitudes</h4>
                                    <div class="table-container">
                                        <?php if($_SESSION['UserLevel'] == $securityLevel->deptAdm) : ?>
                                            <table class="striped highlight ">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Codigo de solicitud</th>
                                                        <th>Codigo del documento</th>
                                                        <th>Nombre del documento</th>
                                                        <th>Estado</th>
                                                        <th>Comentarios</th>
                                                        <th>Ver</th>
                                                        <th>Editar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sols = getSolList();
                                                    $n = 0;
                                                    foreach($sols as $s){
                                                        if(moreThanUserDoc($s['IDUsuarioSubida'])){
                                                            $d = getArchive($s['IDDocumento']);
                                                            echo '<tr>';
                                                                echo '<td>'.$s['FechaActualizacion'].'</td>';
                                                                echo '<td>'.formatSol($s['primKey']).'</td>';
                                                                echo '<td>'.$d['CodigoDocumento'].'</td>';
                                                                echo '<td>'.$d['NombreDocumento'].'</td>';
                                                                echo '<td><div class="st '.getSolState($s['EstadoSolicitud']).'">'.getSolState($s['EstadoSolicitud']).'</div></td>';
                                                                echo '<td>'.$s['ComentarioSolicitud'].'</td>';
                                                                if($s['EstadoSolicitud'] == $solEstatus->Aprobado){
                                                                    echo '<td><a class="btn red2" target="_blank" href="documentos.php?b='.$s['IDDocumento'].'">Ver</a></td>';
                                                                }else{
                                                                    echo '<td><a class="btn red2" target="_blank" href="documentos.php?d='.$s['IDDocumento'].'">Ver</a></td>';
                                                                }
                                                                if($s['EstadoSolicitud'] == $solEstatus->Rechazado or $s['EstadoSolicitud'] == $solEstatus->Aprobado){
                                                                    echo '<td><a class="btn red2" disabled href="#">Editar</a></td>';
                                                                }else{
                                                                    echo '<td><a class="btn red2" href="editArchive.php?d='.$s['IDDocumento'].'&s='.$s['IDSolicitud'].'">Editar</a></td>';
                                                                }
                                                                echo '</tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        <?php elseif($_SESSION['UserLevel'] == $securityLevel->Admin) : ?>

                                            <table class="striped highlight ">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Codigo de solicitud</th>
                                                        <th>Codigo del documento</th>
                                                        <th>Nombre del documento</th>
                                                        <th>Estado</th>
                                                        <th>Comentarios</th>
                                                        <th>Ver</th>
                                                        <th>Responder</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sols = getSolList();
                                                    $n = 0;
                                                    foreach($sols as $s){
                                                        if($s['EstadoSolicitud'] == 1 or $s['IDUsuarioSubida'] == $_SESSION['UserID']){
                                                            $d = getArchive($s['IDDocumento']);
                                                            echo '<tr>';
                                                                echo '<td>'.$s['FechaActualizacion'].'</td>';
                                                                echo '<td class="prKey">'.formatSol($s['primKey']).'</td>';
                                                                echo '<td>'.$d['CodigoDocumento'].'</td>';
                                                                echo '<td>'.$d['NombreDocumento'].'</td>';
                                                                echo '<td><div class="st '.getSolState($s['EstadoSolicitud']).'">'.getSolState($s['EstadoSolicitud']).'</div></td>';
                                                                echo '<td>'.$s['ComentarioSolicitud'].'</td>';
                                                                echo '<td><a class="btn red2" target="_blank" href="documentos.php?d='.$s['IDDocumento'].'">Ver</a></td>';
                                                                echo '<td><a class="btn green2 modal-trigger solicitudes" data-doc="'.$s['IDDocumento'].'" data-id="'.$s['IDSolicitud'].'" href="#respuestaEstado">Responder</a></td>';
                                                            echo '</tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                                    
                                            <!-- Modal Structure -->
                                            <div id="respuestaEstado" class="modal">
                                                <form class="" action="" enctype="multipart/form-data" method="post">
                                                    <div class="modal-content">
                                                        <h4 class="title1 green2-text">Respuesta de la solicitud</h4>
                                                        <div class="row" style="position: fixed; top: -50000000px;">
                                                            <div class="input-field col s12 ">
                                                                <input id="IDSolicitud" name="IDSolicitud" type="text">
                                                                <input id="IDDocumento" name="IDDocumento" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12 ">
                                                                <input id="CodigoSolicitud" name="CodigoSolicitud" type="text" value="test" disabled>
                                                                <label for="CodigoSolicitud">Codigo de la solicitud:</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12 ">
                                                                <select id="Accion" name="Accion"  class="validate[required]">
                                                                    <option value=''>Selecciona la accion a tomar...</option>
                                                                    <option value='0'>Rechazar</option>
                                                                    <option value='2'>Pedir corrección</option>
                                                                    <option value='3'>Aprobar</option>
                                                                </select>
                                                                <label for="Accion">Accion a tomar:</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12 ">
                                                                <textarea name="newComentario" id="newComentario" style="min-height: 150px;"
                                                                    class="materialize-textarea validate[required]"></textarea>
                                                                <label for="newComentario">Comentario:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn green2">Enviar</button>
                                                        <a href="#!" class="modal-close btn red2">Cerrar</a>
                                                    </div>
                                                </form>
                                            </div>

                                        <?php endif ?>
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
    <script type="text/javascript">
        $(".solicitudes").click(function(){
            var input = $(this);
            var id = input.data('id');
            var docID = input.data('doc');
            var solCode = input.parents('tr').find(".prKey").text();
            $("#IDSolicitud").val(id);
            $("#IDDocumento").val(docID);
            $("#CodigoSolicitud").val(solCode);

        })

    </script>
</body>

</html>