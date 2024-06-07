<?php
require_once(__DIR__."/sistema.class.php");

class Perfil extends Sistema{
    function getAll($id_usuario){
        $sql = "SELECT * from orders WHERE id_usuario = :id_usuario";
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $id_usuario = $_SESSION['id_usuario'];
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOne($id_venta){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM order_detail where id_venta = :id_venta");
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNombre($id_usuario){
        $sql = "SELECT cl.nombre as nombre_cliente 
            FROM cliente cl 
            JOIN cliente_usuario cu ON cl.id_cliente = cu.id_cliente
            WHERE cu.id_usuario = :id_usuario;";
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['nombre_cliente'] ;
    }

}
?>