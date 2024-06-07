<?php
require_once(__DIR__ . "/sistema.class.php");
class Cliente extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_cliente, nombre, apellido_paterno, apellido_materno, rfc FROM cliente;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_cliente)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_cliente, nombre, apellido_paterno, apellido_materno, rfc
        FROM cliente
        WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
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
    function Insert($datos)
    {
        $this->connect();
        $stmt = $this->conn->prepare("INSERT INTO cliente (nombre, apellido_paterno, apellido_materno, rfc)
        VALUES (:nombre, :apellido_paterno, :apellido_materno, :rfc);");
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
        $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);       
        $stmt->execute();
        return $stmt->rowCount();
    }


    function Delete($id_cliente)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM cliente
        WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function Update($id_cliente, $datos)
    { //datos es un array
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE cliente SET 
        nombre=:nombre,apellido_paterno=:apellido_paterno,apellido_materno=:apellido_materno,rfc=:rfc        
        WHERE id_cliente=:id_cliente;");
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
        $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function validateCliente($datos)
    {
        if (empty($datos['nombre'])) {
            return false;
        }
        return true;
    }
}
