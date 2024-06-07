<?php
require_once(__DIR__."/sistema.class.php");
class tienda extends Sistema{
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT p.id_tienda, p.tienda, p.latitud, p.longitud, p.fotografia
        FROM tienda p ;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_tienda){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_tienda, tienda, latitud, fotografia , longitud
        FROM tienda
        WHERE id_tienda=:id_tienda;");
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return array();
    }
    function Insert($datos){
        $this->connect();
        $nombre_archvo = $this->upload("tiendas");
        if($nombre_archvo){        
            if ($this->validatetienda($datos)) {
                $stmt=$this->conn->prepare("INSERT INTO tienda
                (tienda, latitud, fotografia, longitud)
                VALUES (:tienda, :latitud , :fotografia, :longitud );");
                $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
                $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                $stmt->bindParam(':fotografia', $nombre_archvo, PDO::PARAM_STR);
                $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount();
            }
        }
        else {
            $stmt=$this->conn->prepare("INSERT INTO tienda
            (tienda)
            VALUES (:tienda);");
            $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }      
    return 0;
    }
    function Delete($id_tienda){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM producto
        WHERE id_producto=:id_producto;");
        $stmt->bindParam(':id_producto', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function Update($id_tienda,$datos){//datos es un array        
        $this->connect();
        print_r($_POST);
        print_r($_GET);
        print_r($_FILES);
        $nombre_archvo = $this->upload('tiendas');
        if($nombre_archvo){
            $stmt=$this->conn->prepare("UPDATE tienda SET 
            tienda=:tienda , latitud=:latitud, fotografia=:fotografia, latitud=:latitud   
            WHERE id_tienda=:id_tienda;");
            $stmt->bindParam(':fotografia', $nombre_archvo, PDO::PARAM_STR);    
        }
        else{
            $stmt=$this->conn->prepare("UPDATE tienda SET 
            tienda=:tienda , latitud=:latitud, id_marca=:id_marca   
            WHERE id_tienda=:id_tienda;");
        }
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
        $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);        
        $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function validatetienda($datos){
        if (empty($datos['tienda'])) {
            return false;
        }
        return true;
    }
}
