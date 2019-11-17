<!DOCTYPE html>
<html lang='es'>

<head>
    <title> Sistema de Gestion de la Calidad - Programa de Medicamentos Esenciales </title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='css/materialize.min.css' />
    <link rel='stylesheet' href='css/styles.css' />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="grey lighten-3">


    <?php 
        include_once("templates/globalIncludes.php");
        include_once("templates/header.php"); 
        include_once("templates/nav.php") 
    ?>


    <section class=''>
        <div class="container">
            <div class="row">
                <div style="height: 300px;" class="valign-wrapper">
                    <div>
                        <h1  class="title1 green2-text" style="font-size: 40px;">
                            BIENVENIDOS AL SISTEMA DE GESTION DE LA CALIDAD EN LINEA 
                        </h1>
                        <p class="parra1">
                            Para poder visualizar los archivos que componen el Sistema de Gestión de la Calidad dale <span class="red2-text">click</span> en la pestaña <span class="red2-text">Documentos</span> en el Menu Principal
                        </p>
                    </div>
                </div>
              
                	
            </div>
        </div>
    </section>
    <!--
     <section class=''>
        <div class="container">
            <div class="row" style="padding-left: 25">
               
       			  <div class="right-align" >
               			 <a class="waves-effect waves-light btn red2 " href="visualizacion.php">Ver Mas
               			 </a>
         		  </div>
       		 </div>
       		</div>
    </section>
-->



<section class='white' style="padding-top: 30px; padding-bottom: 30px; ">
        <div class="container">
            <div class="row">
                <div>
                    <div class="col s12">
                    	
                        <h4  class="title1 green2-text" >
                            Acerca de la plataforma
                        </h4>

                        <p>El Sistema de Gestión de la Calidad es un sistema basado en la norma ISO 9001, este sistema sirve para asegurar el cumplimiento de los objetivos de nuestra institución, mediante una serie de actividades coordinadas que se llevan a cabo sobre un conjunto de elementos para lograr la calidad de los productos o servicios. </p>
                        <p>Dentro del Departamento de Planificación y Desarrollo y todo PROMESE/CAL trabajamos día a día para mejorar nuestros procesos, normas, manuales y políticas, de forma que podamos brindar un mejor servicio al resto de la institución y el resto del país. </p>
                    </div>
                </div>
              
                	
            </div>
        </div>
    </section>

    <footer  class="page-footer grey darken-2">
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