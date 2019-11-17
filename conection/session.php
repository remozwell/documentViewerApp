<?php
   include_once('conn.php');
   session_start();

   function accessLevel($pageLevel){
      $redirect = true;

      if(isset($_SESSION['UserLevel'])){
         if($_SESSION['UserLevel'] >= $pageLevel){
            $redirect = false;
         }
      }
      
      if($redirect){
         header("location: sinacceso.php");
      }
   }

   /*
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from usuarios where NombreUsuario = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['NombreUsuario'];
   /*
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
   */
?>