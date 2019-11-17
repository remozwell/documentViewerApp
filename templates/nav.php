<ul id="slide-nav" class="sidenav">
    
  </ul>

<nav class="green2" id="main-nav">
        <div class="container">
            <div class="row">
                <div class="nav-wrapper">
                    <div class="hide-on-med-and-up">
                        <a href="#" data-target="slide-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    </div>
                    <ul class="right hide-on-small-only">
                        <li><a href="index.php">INICIO</a></li>
                        <li><a href="documentos.php">DOCUMENTOS</a></li>
                        <?php
                            if(isset($_SESSION['login_user'])) {
                                if($_SESSION['UserLevel'] >= $securityLevel->deptAdm) {
                                    //echo '<li><a href="uploadArchive.php">SUBIR DOCUMENTO</a></li>';
                                }

                                if($_SESSION['UserLevel'] >= $securityLevel->deptAdm) {
                                    echo '<li><a href="admin.php">ADMINISTRAR</a></li>';
                                }
                            } 
                        ?>
                    </ul>
                    <!--
                    <ul class="left hide-on-small-only">
                        <li><a href="index.php">SISTEMA DE GESTION DE LA CALIDAD EN LINEA</a></li>
                    </ul>
                    -->
                </div>
            </div>
        </div>
    </nav>