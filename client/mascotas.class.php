<?php
require_once(__DIR__."/sistema.class.php");

class Mascota extends Sistema {
    function getAll() {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM mascota");
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
            $stmt = $this->conn->prepare("INSERT INTO mascota (nombre, raza, edad, id_estado_mascota, id_cliente) VALUES (:nombre, :raza, :edad, :id_estado_mascota, :id_cliente)");
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':raza', $datos['raza'], PDO::PARAM_STR);
            $stmt->bindParam(':edad', $datos['edad'], PDO::PARAM_INT);
            $stmt->bindParam(':id_estado_mascota', $datos['id_estado_mascota'], PDO::PARAM_INT);
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
            $stmt = $this->conn->prepare("UPDATE mascota SET nombre=:nombre, raza=:raza, edad=:edad, id_estado_mascota=:id_estado_mascota, id_cliente=:id_cliente WHERE id_mascota=:id_mascota");
            $stmt->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':raza', $datos['raza'], PDO::PARAM_STR);
            $stmt->bindParam(':edad', $datos['edad'], PDO::PARAM_INT);
            $stmt->bindParam(':id_estado_mascota', $datos['id_estado_mascota'], PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function validateMascota($datos) {
        return !empty($datos['nombre']) && !empty($datos['raza']) && !empty($datos['edad']) && !empty($datos['id_estado_mascota']) && !empty($datos['id_cliente']);
    }
}
?>
