<?php

class cliente_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryClient() {
        try {
            if(isset($_POST['buscar'])){
                $sql = "SELECT*FROM clientes";
            } else {
                $sql = "SELECT*FROM clientes WHERE vigencia like 'true' ";
            }
            
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentCliente = new objectCliente();
                $currentCliente->nombre = $row['Nombre'];
                //echo $row['Nombre'];
                $currentCliente->domicilio = $row['Domicilio'];
                $currentCliente->correo = $row['Correo'];
                $currentCliente->telefono = $row['Telefono'];
                $currentCliente->id = $row['ID_Cliente'];
                $currentCliente->vigencia = $row['vigencia'];
                array_push($items, $currentCliente);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getClient($cliente) {
        try {
            $sql = "SELECT * FROM `clientes` WHERE Nombre LIKE '%" . $cliente . "%' OR Correo LIKE '%" . $cliente . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentCliente = new objectCliente();
                $currentCliente->nombre = $row['Nombre'];
                //echo $row['Nombre'];
                $currentCliente->domicilio = $row['Domicilio'];
                $currentCliente->correo = $row['Correo'];
                $currentCliente->telefono = $row['Telefono'];
                $currentCliente->id = $row['ID_Cliente'];
                $currentCliente->vigencia = $row['vigencia'];
                array_push($items, $currentCliente);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getClientID($clienteID) {
        try {
            $int = (int) $clienteID;
            $sql = "SELECT * FROM `clientes` WHERE ID_Cliente LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentCliente = new objectCliente();
            $currentCliente->nombre = $row['Nombre'];
            //echo $row['Nombre'];
            $currentCliente->domicilio = $row['Domicilio'];
            $currentCliente->correo = $row['Correo'];
            $currentCliente->telefono = $row['Telefono'];
            $currentCliente->id = $row['ID_Cliente'];
            $currentCliente->vigencia = $row['vigencia'];
            return $currentCliente;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($cliente) {
        $sql = "UPDATE clientes SET Correo = '" . $cliente['correo'] . "', Telefono = '" . $cliente['telefono'] . "', Domicilio = '" . $cliente['domicilio'] . "', Nombre = '" . $cliente['nombre'] . "' WHERE ID_Cliente LIKE " . (int) $cliente['id'];
        $this->db->connect()->query($sql);
        return $this->getClientID($cliente['id']);
    }

    function new($cliente) {
        try {
            $sql = "INSERT INTO `clientes`(`Nombre`, `Telefono`, `Domicilio`, `Correo`, `vigencia`) VALUES ('" . $cliente['nombre'] . "','" . $cliente['telefono'] . "','" . $cliente['domicilio'] . "','" . $cliente['correo'] . "','true')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($clienteID) {
        try {
            $sql = "UPDATE clientes SET vigencia = 'false' WHERE ID_Cliente LIKE " . (int) $clienteID;
            $this->db->connect()->query($sql);
            return 'Cliente borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    function restore($clienteID){
        try {
            $sql = "UPDATE clientes SET vigencia = 'true' WHERE ID_Cliente LIKE " . (int) $clienteID;
            $this->db->connect()->query($sql);
            return $this->getClientID($clienteID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectCliente();
        }
    }

}
