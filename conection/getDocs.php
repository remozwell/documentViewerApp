<?php

    include_once("conn.php");
    include_once("helpers.php");
    
    function getArchive($arcID){
        global $db;
        
        $sql = "SELECT * FROM documentos WHERE IDDocumento = '$arcID'";
        
        $result = mysqli_query($db, $sql);

        $archivo = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $archivo;
        //echo $row['NombreDocumento'];

        //$count = mysqli_num_rows($result);
            
    }
    
    function getUptArchive($arcID){
        global $db;
        
        $sql = "SELECT * FROM documentos WHERE CodigoDocumento = '$arcID' and Disponibilidad = 1 order by primKey desc limit 1 ";
        
        $result = mysqli_query($db, $sql);

        $archivo = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $archivo;
        //echo $row['NombreDocumento'];

        //$count = mysqli_num_rows($result);
            
    }

    function avlArchive($docID, $state){
        global $db;
        $archives;
        $sql = "update documentos set 
        Disponibilidad = ".$state."
        where IDDocumento = '".$docID."'";
        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }

    function getDept($dptID){
        global $db;
        $sql = "SELECT * FROM departamentos WHERE IDDepartamento = '$dptID'";
        $result = mysqli_query($db, $sql);
        $dpt = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $dpt;
    }

    function getUser($userID){
        global $db;
        $sql = "SELECT * FROM usuarios WHERE IDUsuario = '$userID'";
        $result = mysqli_query($db, $sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $user;
    }

    function checkUser($userName){
        global $db;
        $sql = "SELECT NombreUsuario FROM usuarios WHERE NombreUsuario = '$userName'";
        $result = mysqli_query($db, $sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $user;
    }

    function getUserList(){
        global $db;
        $depts;
        
        $sql = "SELECT usuarios.*, departamentos.*
        FROM usuarios LEFT JOIN departamentos 
        ON usuarios.IDDepartamento = departamentos.IDDepartamento
        order by usuarios.Nombres desc;
        ";
        $result = mysqli_query($db, $sql);
        //$depts = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$depts = mysqli_fetch_assoc($result);

        return $result;

    }

    
    function getNotList($userID){
        global $db;
        $archives;

        /*$sql = "
        SELECT notificaciones.*, usuarios.Nombres, documentos.NombreDocumento 
        FROM notificaciones 
        LEFT JOIN usuarios on notificaciones.IDUsuario = usuarios.IDUsuario
        LEFT JOIN documentos ON notificaciones.CodigoDocumento = documentos.CodigoDocumento 
        where Leido = 0
        ";*/


        $sql = "
        SELECT t1.* 
		FROM 
        (
            SELECT notificaciones.*, usuarios.Nombres, documentos.NombreDocumento, documentos.IDDocumento, documentos.FechaRevision
            FROM notificaciones 
            LEFT JOIN usuarios on notificaciones.IDUsuario = usuarios.IDUsuario
            LEFT JOIN documentos ON notificaciones.CodigoDocumento = documentos.CodigoDocumento 
            where Leido = 0 
        ) t1 
        WHERE t1.FechaRevision = 
        (
            SELECT MAX(t2.FechaRevision)
            FROM documentos t2
            WHERE t2.CodigoDocumento = t1.CodigoDocumento
        ) and t1.IDUsuario = '".$userID."'

        ";

        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }

    

    function sendNoti($followers, $docCode, $notType){
        global $db;
        $arrayInsert = [];
        foreach($followers as $f){
            $uniqueID =  getGUID();
            $thisQuery = "('".$uniqueID."', '".$docCode."','".$f['IDUsuario']."', 0, ".$notType.", now())";
            array_push($arrayInsert, $thisQuery);
        }
        $fullQuery = implode (", ", $arrayInsert);
        
        $cleanSQL = "update notificaciones set Leido = 1 where CodigoDocumento = '".$docCode."' ;";
        $result = mysqli_query($db, $cleanSQL);

        $sql = "
        INSERT INTO notificaciones
            (IDNotificacion,CodigoDocumento,IDUsuario, Leido, TipoNotificacion, FechaNotificacion)
        VALUES
            ".$fullQuery.";
        ";        
        $result = mysqli_query($db, $sql);
        //$count = mysqli_num_rows($result);
        //return $count;
    }

    function readNoti($docCode, $userID, $notType){
        global $db;
        $sql = "
        update notificaciones set
        Leido = 1
        where CodigoDocumento = '".$docCode."' 
        and IDUsuario = '".$userID."'
        and TipoNotificacion = ".$notType."
        ";
        $result = mysqli_query($db, $sql);

    }

    function addFollower($userID, $codDocumento){
        global $db;
        $uniqueID =  getGUID();
        $sql = "insert into seguidores 
            (IDSeguidor, CodigoDocumento, IDUsuario) values 
            ('".$uniqueID."','".$codDocumento."', '".$userID."')";

        $result = mysqli_query($db, $sql);

    }

    function deleteFollower($userID, $codDocumento){
        global $db;
        $sql = "delete from seguidores where
        CodigoDocumento = '".$codDocumento."' and
        IDUsuario = '".$userID."'";        
        $result = mysqli_query($db, $sql);

    }

    function isFollowing($userID, $codDocumento){
        global $db;
        $sql = "select * from seguidores where
        CodigoDocumento = '".$codDocumento."' and
        IDUsuario = '".$userID."'";        
        $result = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function getFollowers($codDocumento){
        global $db;
        $sql = "select * from seguidores where
        CodigoDocumento = '".$codDocumento."'";        
        $result = mysqli_query($db, $sql);
        //$count = mysqli_num_rows($result);
        return $result;
    }

    function getAdmins($docID){
        global $db;
        global $securityLevel;
        $sql = "select * from usuarios where
        (NivelUsuario = ".$securityLevel->deptAdm." and IDDepartamento = '".$docID."')
        or
        (NivelUsuario > ".$securityLevel->deptAdm.")";        
        $result = mysqli_query($db, $sql);
        //$count = mysqli_num_rows($result);
        return $result;
    }

    function getDocList(){
        global $db;
        $archives;

        $sql = "
        SELECT t1.* FROM documentos t1 
        WHERE t1.primKey = 
        (SELECT MAX(t2.primKey)
        FROM documentos t2
        WHERE t2.CodigoDocumento = t1.CodigoDocumento and t2.Disponibilidad = 1)
        order by t1.NombreDocumento asc
        ";
        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }


    function getRevList($docCode){
        global $db;
        $archives;

        $sql = "
        select * from documentos
        where CodigoDocumento = '".$docCode."'
        order by primKey desc
        ";
        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }

    function docExist($docCode){
        global $db;
        $sql = "SELECT * FROM documentos WHERE CodigoDocumento = '$docCode'";
        $result = mysqli_query($db, $sql);
        $doc = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        if(mysqli_num_rows($result) > 0){
            return $doc;
        }else{
            return false;
        }

    }

    function getDeptList(){
        global $db;
        $depts;
        
        $sql = "SELECT * FROM departamentos order by NombreDepartamento asc";
        $result = mysqli_query($db, $sql);
        //$depts = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$depts = mysqli_fetch_assoc($result);

        return $result;
      

    }

    function getComments($idDoc){
        global $db;
        $depts;
        
        $sql = "SELECT * FROM comentarios where IDDocumento = '".$idDoc."' order by primKey desc";
        $result = mysqli_query($db, $sql);
        //$depts = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$depts = mysqli_fetch_assoc($result);

        return $result;
      

    }

    function saveArchive($docName, $deptID, $docCode, $docLevel, $docRev, $docArchive, $fechaEmision, $elaboradoID, $revisadoID, $aprobadoID, $vistoID ){
        global $db;
        $uniqueID =  getGUID();
        $sql = "insert into documentos 
        (IDDocumento, 
        IDDepartamento, 
        ElaboradoPor, 
        RevisadoPor, 
        AprobadoPor, 
        VistoPor, 
        NombreDocumento, 
        Disponibilidad, 
        CodigoDocumento, 
        FechaEmision, 
        NumeroRevision, 
        FechaRevision) 

        values 

        ('".$uniqueID."',
        '".$deptID."', 
        '".$elaboradoID."', 
        '".$revisadoID."', 
        '".$aprobadoID."', 
        '".$vistoID."', 
        '".$docName."', 
        '".$docLevel."', 
        '".$docCode."', 
        '".$fechaEmision."', 
        '".$docRev."', 
        now() )";

        $result = mysqli_query($db, $sql);


        $targetfolder = "files/";
        $targetfolder = $targetfolder.basename($uniqueID.".pdf");
        move_uploaded_file($docArchive, $targetfolder);

        return $uniqueID;

    }

    function editArchive($uniqueID, $docName, $docRev, $docArchive, $elaboradoID, $revisadoID, $aprobadoID, $vistoID ){
        global $db;
        $sql = "update documentos set
        ElaboradoPor = '".$elaboradoID."',
        RevisadoPor = '".$revisadoID."',
        AprobadoPor = '".$aprobadoID."',
        VistoPor = '".$vistoID."',
        NombreDocumento = '".$docName."',
        Disponibilidad = '0',
        NumeroRevision = '".$docRev."'
        where IDDocumento = '".$uniqueID."' ";

        $result = mysqli_query($db, $sql);

        if($docArchive != false){
            unlink("files/".$uniqueID.".pdf");

            $targetfolder = "files/";
            $targetfolder = $targetfolder.basename($uniqueID.".pdf");
            move_uploaded_file($docArchive, $targetfolder);
        }

        return $uniqueID;

    }

    function saveComment($docID, $userID, $comment){
        global $db;
        $uniqueID =  getGUID();
        $sql = "insert into Comentarios	(IDComentario, IDDocumento, IDUsuario, Comentario, FechaComentario) values 
        ('".$uniqueID."','".$docID."', '".$userID."', '".$comment."', now())";

        $result = mysqli_query($db, $sql);

        
    }
    
    function saveUser($userName, $pass, $Name, $Last, $userLvl, $deptID, $email){
        global $db;
        $uniqueID =  getGUID();
        $sql = "insert into usuarios 
        (IDUsuario, NombreUsuario, Contrasena, NivelUsuario, IDDepartamento, Nombres, Apellidos, Email, FechaCreacion, Estado)
        values
        ('".$uniqueID."', '".$userName."', '".$pass."', '".$userLvl."', '".$deptID."', '".$Name."', '".$Last."', '".$email."', now(), 1)";

        $result = mysqli_query($db, $sql);

    }

    function updateUser($userID, $userLvl, $estado){
        global $db;
        /*$sql = "update usuarios set
        Nombres = '".$userName."', Apellidos = '".$userLast."', NivelUsuario = '".$userLvl."',
        IDDepartamento = '".$deptID."', FechaNacimiento = '".$fechaNacimiento."',
        Email = '".$email."', Telefono = '".$telefono."', Estado = '".$estado."'
        where IDUsuario = '".$userID."'";*/

        $sql = "update usuarios set
        NivelUsuario = '".$userLvl."',
        Estado = '".$estado."'
        where IDUsuario = '".$userID."'";

        $result = mysqli_query($db, $sql);

    }

  
    function saveSol($docID, $upUserID){
        global $db;
        global $solEstatus;
        $uniqueID =  getGUID();
        $sql = "insert into solicitudes 
        (IDSolicitud, 
        IDDocumento, 
        IDUsuarioSubida, 
        FechaSolicitud,
        EstadoSolicitud,
        FechaActualizacion) 

        values 

        ('".$uniqueID."',
        '".$docID."', 
        '".$upUserID."', 
        now(), 
        ".$solEstatus->Pendiente.", 
        now()
        )";

        $result = mysqli_query($db, $sql);

    }

    
    function editSol($upUserID, $solID){
        global $db;
        global $solEstatus;

        $sql = "update solicitudes set
            IDUsuarioSubida = '".$upUserID."',
            EstadoSolicitud = '".$solEstatus->Pendiente."',
            FechaActualizacion = now()
            where IDSolicitud = '".$solID."' ";


        $result = mysqli_query($db, $sql);

    }


    function getSol($solID){
        global $db;
        $archives;
        $sql = "select * from solicitudes where IDSolicitud = '".$solID."'";
        
        $result = mysqli_query($db, $sql);
        $archivo = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $archivo;
    }


    function getSolList(){
        global $db;
        $archives;
        $sql = "select * from solicitudes order by FechaActualizacion desc";
        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }

    
    function changeSolState($userID, $idSol, $estado, $comment){
        global $db;
        $archives;
        $sql = "update solicitudes set 
        IDUsuarioAdmin = '".$userID."',
        EstadoSolicitud = ".$estado.",
        ComentarioSolicitud = '".$comment."'
        where IDSolicitud = '".$idSol."'";
        $result = mysqli_query($db, $sql);
        //$archives = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $result;
    }

?>