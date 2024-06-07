<?php
require_once(__DIR__."/sistema.class.php");
class citas extends Sistema{
    function getClientes() {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_cliente, concat(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre_completo FROM cliente");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getAll(){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT c.`id_cita`, 
        concat(cl.nombre,' ',cl.apellido_paterno,' ',cl.apellido_materno ) as nombre_cliente 
            ,`fecha_cita`,`notas`, e.estado_cita
        FROM `cita` c 
        join estado_cita e on c.id_estado_cita= e.id_estado_cita
        join cliente cl on cl.id_cliente = c.id_cliente ;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }
    function getOne($id_citas){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT c.`id_cita`, c.`id_cliente`, c.`fecha_cita`, c.`notas`, c.`id_estado_cita`, e.`estado_cita`
        FROM `cita` c 
        JOIN `estado_cita` e ON c.`id_estado_cita` = e.`id_estado_cita`
        WHERE c.`id_cita` = :id_cita;");
        $stmt->bindParam(':id_cita', $id_citas, PDO::PARAM_INT);
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
    function insert($datos) {
        $this->connect();
        if ($this->validateCita($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO `cita`
                (id_cliente, fecha_cita, notas, id_estado_cita)
                VALUES (:id_cliente, :fecha_cita, :notas, :id_estado_cita);");
            $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':fecha_cita', $datos['fecha_cita'], PDO::PARAM_STR);
            $stmt->bindParam(':notas', $datos['notas'], PDO::PARAM_STR);
            $stmt->bindParam(':id_estado_cita', $datos['id_estado_cita'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function Delete($id_citas){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM citas
        WHERE id_citas=:id_citas;");
        $stmt->bindParam(':id_citas', $id_citas, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function update($id_cita, $datos) {
        $this->connect();
        if ($this->validateCita($datos)) {
            $stmt = $this->conn->prepare("UPDATE `cita` SET 
                id_cliente = :id_cliente, 
                fecha_cita = :fecha_cita, 
                notas = :notas, 
                id_estado_cita = :id_estado_cita   
                WHERE id_cita = :id_cita;");
            $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':fecha_cita', $datos['fecha_cita'], PDO::PARAM_STR);
            $stmt->bindParam(':notas', $datos['notas'], PDO::PARAM_STR);        
            $stmt->bindParam(':id_estado_cita', $datos['id_estado_cita'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }
    function validatecitas($datos){
        if (empty($datos['citas'])) {
            return false;
        }
        return true;
    }

    function validateCita($datos) {
        if (empty($datos['id_cliente']) || empty($datos['fecha_cita']) || empty($datos['id_estado_cita'])) {
            return false;
        }
        return true;
    }
}
