<?php
require_once(__DIR__."/sistema.class.php");

class Empleado extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_empleado, apellido_paterno, apellido_materno, nombre, rfc, curp FROM empleado;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_empleado){
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_empleado, apellido_paterno, apellido_materno, nombre, rfc, curp
        FROM empleado
        WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
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
        if ($this->validateEmpleado($datos)) {
            $stmt=$this->conn->prepare("INSERT INTO empleado 
            (apellido_paterno, apellido_materno, nombre, rfc, curp)
            VALUES (:apellido_paterno, :apellido_materno, :nombre, :rfc, :curp);");
            $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
            $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return false;
    }

    function Delete($id_empleado){
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM empleado
        WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function Update($id_empleado,$datos){//datos es un array
        $this->connect();
        $stmt=$this->conn->prepare("UPDATE empleado SET 
        apellido_paterno=:apellido_paterno,
        apellido_materno=:apellido_materno,
        nombre=:nombre,
        rfc=:rfc,
        curp=:curp
        WHERE id_empleado=:id_empleado;");
        $stmt->bindParam(':apellido_paterno', $datos['apellido_paterno'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido_materno', $datos['apellido_materno'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
        $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validateEmpleado($datos){        
        if(empty($datos['nombre'])){
            return false;
        }
        if(empty($datos['rfc']) ){            
            return false;
        }
        if(empty($datos['curp'])){
            return false;
        }        
        if($this->validaRFC($datos['rfc'])){
            return false;
        }
        if($this->validarCURP($datos['curp'])){
            return false;
        }
        return true;
    }
    
    function validarCURP($curp){
        $regex = '/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}[A-Z]{1}[0-9]{2}[A-Z]{1}$/';
        return preg_match($regex, $curp);
    }

    function validaRFC($rfc){
        $regex = '/^([A-Z&Ñ]{3,4})([0-9]{2})([0-1]{1})([0-9]{1})([A-Z0-9]{3})$/';
        return preg_match($regex, $rfc);
    }

}
?>
