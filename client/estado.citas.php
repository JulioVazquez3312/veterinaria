<?php
require_once(__DIR__."/sistema.class.php");
class EstadoCitas extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_estado_cita , estado_cita FROM estado_cita ;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_estado_cita){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_estado_cita , estado_cita
        FROM estado_cita
        WHERE id_estado_cita=:id_estado_cita;");
        $stmt->bindParam(':id_estado_cita', $id_estado_cita, PDO::PARAM_INT);
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
        $nombre_archvo = $this->upload("estado_citas");
        if($nombre_archvo){
            if ($this->validateestado_cita($datos)) {
                $stmt=$this->conn->prepare("INSERT INTO estado_cita 
                (estado_cita,)
                VALUES (:estado_cita, );");
                $stmt->bindParam(':estado_cita', $datos['estado_cita'], PDO::PARAM_STR);
                $stmt->bindParam('', $nombre_archvo, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
            }
            else{
                $stmt=$this->conn->prepare("INSERT INTO estado_cita 
                (estado_cita)
                VALUES (:estado_cita );");
                $stmt->bindParam(':estado_cita', $datos['estado_cita'], PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
            }            
        }
    }

    function Delete($id_estado_cita){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM estado_cita
        WHERE id_estado_cita=:id_estado_cita;");
        $stmt->bindParam(':id_estado_cita', $id_estado_cita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function Update($id_estado_cita,$datos){//datos es un array
        $this->connect();
        $stmt=$this->conn->prepare("UPDATE estado_cita SET 
        estado_cita=:estado_cita
        WHERE id_estado_cita=:id_estado_cita;");
        $stmt->bindParam(':estado_cita', $datos['estado_cita'], PDO::PARAM_STR);
        $stmt->bindParam(':id_estado_cita', $id_estado_cita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function validateestado_cita($datos){
        if (empty($datos['estado_cita'])) {
            return false;
        }
        return true;
    }
}
