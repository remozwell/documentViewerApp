<?php 
    //include "../conection/conn.php";
    include_once("conection/session.php");
?>

<header class='white'>
    <div class="container">
        <div class="row">
            <div class="col m6 s12">
                <img src="images/logo.png" class="logo" />
            </div>
            <div class="col m6 s12 right-align" style="margin-top: 47px;">
                <?php if(!isset($_SESSION['login_user'])) : ?>
                    <div class="loginBtn">
                        <a href="login.php" class="btn red2">Iniciar sesion</a>
                    </div>
                <?php else : ?>

                    <ul id='notiMenu' class='dropdown-content'>
                        <?php
                            $not = getNotList($_SESSION['UserID']);
                            foreach($not as $n){
                                //$leido = $n['Leido'] == 1 ? 'newNot' : '';
                                if($n['TipoNotificacion'] == 1){
                                    echo '<li class=""> <a class="not-container" href="documentos.php?b='.$n['IDDocumento'].'">';
                                    //echo '<h6 class="green2-text"><b>'.$n['Nombres'].'</b></h6>';
                                    echo '<p class="not-msj">El documento llamado "'.$n['NombreDocumento'].'" a sido actualizado.</p>';
                                }else if($n['TipoNotificacion'] == 2){
                                    echo '<li class=""> <a class="not-container" href="comentarios.php?b='.$n['IDDocumento'].'">';
                                    echo '<p class="not-msj">El documento llamado "'.$n['NombreDocumento'].'" Tiene un nuevo comentario.</p>';
                                }
                                echo '<p class="not-date">'.$n['FechaNotificacion'].'</p>';
                                echo '</a></li>';
                            }
                        ?>
                    </ul>

                    <div class="userLogged">
                        <a id="notMsg" class="dropdown-trigger" data-target='notiMenu' href='#'>
                            <div class="red2 white-text"><?php echo mysqli_num_rows($not);  ?></div>
                            <i class="material-icons">message</i>
                        </a>
                        <a class='dropdown-trigger userBtn' href='#' data-target='userMenu'><?php echo $_SESSION['login_user'] ?> <i class="material-icons">arrow_drop_down</i></a>
                    </div>

                    <ul id='userMenu' class='dropdown-content'>
                        <!--
                        <?php if($_SESSION['UserLevel'] >= $securityLevel->deptAdm): ?>
                            <li><a href="solicitudes.php">Solicitudes</a></li>
                        <?php endif; ?>
                        <li><a href="changePassword.php">Cambiar contraseña</a></li>
                        
                        <?php if($_SESSION['UserLevel'] >= $securityLevel->deptAdm): ?>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="admin.php">Administración<i class="material-icons">settings</i></a></li>
                        <?php endif; ?>
                        <li class="divider" tabindex="-1"></li>
                        -->
                        <li><a href="conection/logout.php">Cerrar sesion<i class="material-icons">power_settings_new</i></a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>