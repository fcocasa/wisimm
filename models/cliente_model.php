<?php

class cliente_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryClient() {
        try {
            $sql = 'SELECT*FROM clientes';
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
            $sql = "SELECT * FROM `clientes` WHERE Nombre LIKE '%" . $cliente . "%' OR Correo LIKE '%" . $cliente . "%'";
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
            return $currentCliente;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }
    
    function modify($cliente){
         $sql = "UPDATE clientes SET Correo = '".$cliente['correo']."', Telefono = '".$cliente['telefono']."', Domicilio = '".$cliente['domicilio']."', Nombre = '".$cliente['nombre']."' WHERE ID_Cliente LIKE ".(int)$cliente['id'];
         $this->db->connect()->query($sql);
         return $this->getClientID($cliente['id']);
         }

}
