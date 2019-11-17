<?php
$securityLevel = new stdClass();
$securityLevel->Master = 20;
$securityLevel->Admin = 3;
$securityLevel->deptAdm = 2;
$securityLevel->User = 1;
$securityLevel->All = 0;



$estadoUsuario = new stdClass();
$estadoUsuario->Activo = 1;
$estadoUsuario->Inactivo = 0;

$solEstatus = new stdClass();
$solEstatus->Rechazado = 0;
$solEstatus->Pendiente = 1;
$solEstatus->Correccion = 2;
$solEstatus->Aprobado = 3;

?>