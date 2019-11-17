<?php
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = //chr(123)// "{"
            substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
            //.chr(125);// "}"
        return $uuid;
    }
}

function getSecLevel($lvl){
    global $securityLevel;
    switch ($lvl) {
        case $securityLevel->User:
            return 'Usuario';
            break;
        case $securityLevel->deptAdm:
            return 'Administrador de departamento';
            break;
        case $securityLevel->Admin:
            return 'Administrador';
            break;
        case $securityLevel->Master:
            return 'Maestro de sistema';
    }
}

function getUserState($lvl){
    global $estadoUsuario;
    switch ($lvl) {
        case $estadoUsuario->Activo:
            return 'Activo';
            break;
        case $estadoUsuario->Inactivo:
            return 'Inactivo';
            break;
    }
}

function getSolState($lvl){
    global $solEstatus;
    switch ($lvl) {
        case $solEstatus->Rechazado:
            return 'Rechazado';
            break;
        case $solEstatus->Pendiente:
            return 'Pendiente';
            break;
        case $solEstatus->Correccion:
            return 'Correccion';
            break;
        case $solEstatus->Aprobado:
            return 'Aprobado';
            break;
    }
}

function moreThanDeptAdm($deptID){
    global $securityLevel;
    if(($_SESSION['UserLevel'] >= $securityLevel->deptAdm and $_SESSION['UserDept'] == $deptID)
    or $_SESSION['UserLevel'] >= $securityLevel->Admin){
        return true;
    }else{
        return false;
    }
}
function moreThanUserDoc($userID){
    global $securityLevel;
    if(($_SESSION['UserLevel'] >= $securityLevel->deptAdm and $_SESSION['UserID'] == $userID)
    or $_SESSION['UserLevel'] >= $securityLevel->Admin){
        return true;
    }else{
        return false;
    }
}

function formatSol($id){
    return sprintf("CU%1$04d", $id);
}

?>