<?php
require __DIR__ ."/config.php";
class Sistema extends Config{
    var $conn;
    var $count=0;
    function connect()
    {
        /*
        $servername = "localhost";
        $username = "fereteria";
        $password = "123";
        $dbname = "ferreteria";
        */
        $this->conn = new PDO(DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,DB_USER, DB_PASSWORD);
        //$this->conn= new PDO("mysql:host=$servername;dbname=ferreteria", $username, $password);
    }

    function query($sql){
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos; // Devuelve los datos obtenidos de la consulta
    }

    function setCount($count){
        $this->count = $count;
    }
    function getCount(){
        return $this->count;
    }

    function upload($carpeta){
        $permitidos =$this->getImageType();
        if(in_array($_FILES['fotografia']['type'],$permitidos)){
            if($_FILES['fotografia']['size'] >= $this->getImageSize()){
                $n = rand(1,1000000);
                $nombre_archivo=$n.$_FILES['fotografia']['size'].$_FILES['fotografia']['name'];
                $nombre_archivo=md5($nombre_archivo);
                $extencion=explode('.',$_FILES['fotografia']['name']);
                $extencion = $extencion[sizeof($extencion)-1];
                $nombre_archivo=$nombre_archivo.'.'.$extencion;
                
                if(!file_exists('../uploads/.'.$carpeta.'/'.$nombre_archivo)){
                    move_uploaded_file($_FILES['fotografia']['tmp_name'],"../uploads/".$carpeta."/".$nombre_archivo);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }

    function getRol($correo){
        $sql = "SELECT r.roles from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol r on ur.id_rol = r.id_rol
        where u.correo ='".$correo."';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['roles']);
        return $info;
        //return $datos;
    }

    function getPrivilegios($correo){
        $sql = "SELECT p.privilegios
        from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol_privilegio rp on ur.id_rol = rp.id_rol
        join privilegio p on rp.id_privilegio = p.id_privilegio
        where u.correo = '".$correo."';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['privilegios']);
        return $info;
        
        //return $datos;
    }

    function login($correo, $password){
        $password = md5($password);
        $this->connect();
        $sql = 'SELECT * from usuario
        where correo = :correo and password = :password';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
        $stmt->bindParam(':password',$password, PDO::PARAM_STR);
        $stmt -> execute();
        $datos = array();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $roles = array();
            $roles = $this->getRol($correo);
            $privilegios = array();
            $privilegios = $this -> getPrivilegios($correo);
            $_SESSION['correo'] = $correo;
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            return $datos[0];
        }
        else{
            $this->logout();            
        }
        return false;
    }

    function logout(){
        unset($_SESSION);
        session_destroy();
    }

    function checkRol($rol, $kill = false){
        if(isset($_SESSION['roles'])){
            if($_SESSION['validado']){
                if(in_array($rol,$_SESSION['roles'])){
                    return true;
                }
            }
        }
        if($kill){
            $this->logout();
            $this->alert('danger','Permiso denegado');
            die;
        }
        return false;
    }

    function checkPrivilegios($privilegios, $kill = false){
        if(isset($_SESSION['privilegios'])){
            if($_SESSION['validado']){
                if(in_array($privilegios,$_SESSION['privilegios'])){
                    return true;
                }
            }
        }
        if($kill){
            $this->logout();
        }
        return false;
    }

    function alert($type,$mensaje){
        $alerta = array();
        $alerta['tipo'] = $type;
        $alerta['mensaje']=$mensaje;
        include __DIR__.'/views/alert.php';
    }
/*
    function reset($correo){
        if(filter_var($correo)){
            $this->connect();
            $sql="SELECT * FROM usuarios WHERE correo =:correo;";
            $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
            $stmt->execute();
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                $token1 = md5($correo, 'Alea1Token64');
                $token2 = md5($correo, 'Aletorio2Token64');

        }
    }
    */


}
?>