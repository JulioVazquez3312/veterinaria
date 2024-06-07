<?php
require_once(__DIR__."/../client/sistema.class.php");

class Mascota extends Sistema {

    function getIdclient($id_usuario) {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT cl.id_cliente as id_cliente
        FROM cliente cl
        JOIN cliente_usuario cu ON cl.id_cliente = cu.id_cliente
        WHERE cu.id_usuario = :id_usuario;");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getAllByUser($user_id) {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM mascota WHERE id_cliente=:id_cliente");
        $stmt->bindParam(':id_cliente', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_mascota) {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM mascota WHERE id_mascota=:id_mascota");
        $stmt->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);
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

    function Insert($datos) {
        $this->connect();
        if ($this->validateMascota($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO mascota (nombre, raza, edad, estado_mascota, id_cliente) VALUES (:nombre, :raza, :edad, :estado_mascota, :id_cliente)");
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':raza', $datos['raza'], PDO::PARAM_STR);
            $stmt->bindParam(':edad', $datos['edad'], PDO::PARAM_INT);
            $stmt->bindParam(':estado_mascota', $datos['estado_mascota'], PDO::PARAM_STR); // Cambio a PDO::PARAM_STR
            $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function Delete($id_mascota) {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM mascota WHERE id_mascota=:id_mascota");
        $stmt->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function Update($id_mascota, $datos) {
        $this->connect();
        if ($this->validateMascota($datos)) {
            $stmt = $this->conn->prepare("UPDATE mascota SET nombre=:nombre, raza=:raza, edad=:edad, estado_mascota=:estado_mascota, id_cliente=:id_cliente WHERE id_mascota=:id_mascota");
            $stmt->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':raza', $datos['raza'], PDO::PARAM_STR);
            $stmt->bindParam(':edad', $datos['edad'], PDO::PARAM_INT);
            $stmt->bindParam(':estado_mascota', $datos['estado_mascota'], PDO::PARAM_STR); // Cambio a PDO::PARAM_STR
            $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function validateMascota($datos) {
        return !empty($datos['nombre']) && !empty($datos['raza']) && !empty($datos['edad']) && !empty($datos['estado_mascota']) && !empty($datos['id_cliente']);
    }
}
?>