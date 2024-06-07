<?php
require __DIR__ ."/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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
        if(in_array($_FILES['fotografia']['type'],$this->getImageType())){
            if($_FILES['fotografia']['size'] <= $this->getImageSize()){
                $n = rand(1,1000000);
                $nombre_archivo=$n.$_FILES['fotografia']['size'].$_FILES['fotografia']['name'];
                $nombre_archivo=md5($nombre_archivo);
                $extencion=explode('.',$_FILES['fotografia']['name']);
                $extencion = $extencion[sizeof($extencion)-1];
                $nombre_archivo=$nombre_archivo.'.'.$extencion;
                
                if(!file_exists('../uploads/.'.$carpeta.'/'.$nombre_archivo)){
                    move_uploaded_file($_FILES['fotografia']['tmp_name'],"../uploads/".$carpeta."/".$nombre_archivo);
                    return $nombre_archivo;
                }else{
                    $alerta['tipo']="danger";
                    $alerta['mensaje']="Error al subir el archivo";                   
                    include('views/alert.php');
                }
            }
            else{
                $alerta['tipo']="danger";
                $alerta['mensaje']="Tipo de archivo no permitido o tamaño excedido";                   
                include('views/alert.php');
            }
        }
        else{
            $alerta['tipo']="warning";
            $alerta['mensaje']=" No se proporcionó un archivo o hubo errores al cargarlo";                   
            include('views/alert.php');
        }
        return false;
    }


    function getRol($correo){
        $sql = "SELECT r.rol as roles from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol r on ur.id_rol = r.id_rol
        where u.correo ='".$correo."';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['roles']);
        return $info;
    }

    function getPrivilegios($correo){
        $sql = "SELECT p.privilegio as privilegios
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
            $_SESSION['validado'] = true;
            $_SESSION['correo'] = $correo;
            $_SESSION['id_usuario'] = $datos[0]['id_usuario'];
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            return $datos[0];
        }
        else{
            $this->alert('warning','No tienes una cuenta');
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

    function reset($correo){
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)){   
            $this->connect();
            $sql= 'SELECT * from usuario where correo=:correo';
            $stmt=$this->conn->prepare($sql);
            $stmt->bindparam(':correo', $correo,PDO::PARAM_STR);
            $stmt->execute();
            $datos=array();
            $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos=$stmt->fetchAll();
            if(isset($datos[0])){
                $token1=md5($correo.'AleaToRios52');
                $token2=md5($correo.date('Y-m-d H:i:s'.rand(1,1000000)));
                $token=$token1.$token2;
                $sql='UPDATE usuario set token=:token where correo=:correo;';
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->execute();
                $destinatario=$correo;
                $nombre_destinatario='Juanito Bananas';
                $asunto='Recuperacion de Contraseña';
                $mensaje="Hola se ha solicitado un cambio de contrasena para tu cuenta.</br>
                Usted puede recuperarla presionando el siguiente enlace </br>".
                "<a href='http://localhost/client/login.php?action=recovery&token=" . $token . "'>Recuperar contraseña</a>".
                "Muchas gracias</br>
                Ferreteria";
                if($this->sendMail($destinatario,$nombre_destinatario,$asunto,$mensaje)){
                    return true;
                }else{
                    return false;
                }
                return true;
            }
        }
    }

    function sendMail($destinatario,$nombre_destinatario,$asunto,$mensaje){
        require_once '../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host='smtp.gmail.com';
        $mail->Port=465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth=true;
        $mail->Username='correo';
        //$mail->Password='clave2 pasos';
        $mail->Password='clave2 pasos';
        $mail->setFrom('correo','nombre');
        $mail->addAddress($destinatario,$nombre_destinatario);
        $mail->Subject=$asunto;
        $mail->msgHTML($mensaje);
        if(!$mail->send()){
            return false;
        }else{
            return true;
        }
        
    }

    function recovery($token,$password=null){
        $this->connect();
        if (strlen($token) == 64) {
            $sql = "SELECT * FROM usuario WHERE token = :token;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            $datos = array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                if (!is_null($password)) {
                    $password = md5($password);
                    $correo = $datos[0]['correo'];
                    $sql = "UPDATE usuario SET password = :password, token = null WHERE correo = :correo";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $stmt->execute();
                }
                return true;
            }
        }
        return false;
    }
        
        function registrar($datos) {
            if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
                $this->alert('danger', 'Correo no valido');
                return false;
            }
        
            $this->connect();
        
            try {
                $this->conn->beginTransaction();
        
                $sql = "SELECT * FROM usuario WHERE correo = :correo";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                $stmt->execute();
                $usuario = $stmt->fetchAll();
        
                if (isset($usuario[0])) {
                    $this->alert('danger', 'Correo ya registrado');
                    $this->conn->rollBack();
                    return false;
                }
        
                $sql = "INSERT INTO usuario (correo, password) VALUES (:correo, :password)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                $contrasena = md5($datos['password']);
                $stmt->bindParam(':password', $contrasena, PDO::PARAM_STR);
                $stmt->execute();

                // Obtener el id_usuario recién insertado
                $id_usuarioUltimo = $this->conn->lastInsertId();                
        
                $sql = "SELECT * FROM usuario WHERE correo = :correo";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
                $stmt->execute();
                $usuario = $stmt->fetchAll();
        
                if (isset($usuario[0])) {
                    $id_usuario = $usuario[0]['id_usuario'];
        
                    $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, 3)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();
        
                    $sql = "INSERT INTO cliente (nombre, apellido_paterno, apellido_materno, rfc) 
                            VALUES (:nombre, :apellido_paterno, :apellido_materno, :rfc)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
                    $stmt->bindParam(':apellido_paterno', $datos['primer_apellido'], PDO::PARAM_STR);
                    $stmt->bindParam(':apellido_materno', $datos['segundo_apellido'], PDO::PARAM_STR);
                    $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
                    $stmt->execute();

                    // Obtener el id_cliente recién insertado
                    $id_cliente = $this->conn->lastInsertId();

                    $sql = "INSERT INTO cliente_usuario (id_usuario, id_cliente) VALUES (:id_usuario, :id_cliente)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuarioUltimo, PDO::PARAM_INT);
                    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
                    $stmt->execute();
        
                    $this->conn->commit();
                    $this->alert('success', 'Registro exitoso');
                    $this->sendMail($datos['correo'],$datos['nombre'],"Gracias por registrarse ". $datos['nombre'],"Gracias por registrarse en nuestro sitio");
                    return true;
                } else {
                    $this->alert('danger', 'Error al registrar');
                    $this->conn->rollBack();
                    return false;
                }
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $this->alert('danger', "Error: " . $e->getMessage());
                return false;
            }
        }
        
        public function validateEmail($emal){
            if(filter_var($emal, FILTER_VALIDATE_EMAIL)){
                return true;
            }
        }

}

?>