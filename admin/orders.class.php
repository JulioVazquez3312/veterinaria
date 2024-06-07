<?php
require_once(__DIR__."/sistema.class.php");
class Order extends Sistema{
    function getAll(){
        $sql = "SELECT * from orders order by 2 desc;";
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }
}
?>