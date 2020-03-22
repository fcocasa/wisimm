<?php

class cambiar_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEverycambiar() {
        try {
            if(isset($_POST['buscar'])){
                $sql = "SELECT*FROM cambiar";
            } else {
                $sql = "SELECT*FROM cambiar WHERE vigencia like 'true' ";
            }
            
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentcambiar = new objectcambiar();
                $currentcambiar->nombre = $row['Nombre'];
                //echo $row['Nombre'];
                $currentcambiar->domicilio = $row['Domicilio'];
                $currentcambiar->correo = $row['Correo'];
                $currentcambiar->telefono = $row['Telefono'];
                $currentcambiar->id = $row['ID_cambiar'];
                $currentcambiar->vigencia = $row['vigencia'];
                array_push($items, $currentcambiar);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getcambiar($cambiar) {
        try {
            $sql = "SELECT * FROM `cambiar` WHERE Nombre LIKE '%" . $cambiar . "%' OR Correo LIKE '%" . $cambiar . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentcambiar = new objectcambiar();
                $currentcambiar->nombre = $row['Nombre'];
                //echo $row['Nombre'];
                $currentcambiar->domicilio = $row['Domicilio'];
                $currentcambiar->correo = $row['Correo'];
                $currentcambiar->telefono = $row['Telefono'];
                $currentcambiar->id = $row['ID_cambiar'];
                $currentcambiar->vigencia = $row['vigencia'];
                array_push($items, $currentcambiar);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getcambiarID($cambiarID) {
        try {
            $int = (int) $cambiarID;
            $sql = "SELECT * FROM `cambiar` WHERE ID_cambiar LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentcambiar = new objectcambiar();
            $currentcambiar->nombre = $row['Nombre'];
            //echo $row['Nombre'];
            $currentcambiar->domicilio = $row['Domicilio'];
            $currentcambiar->correo = $row['Correo'];
            $currentcambiar->telefono = $row['Telefono'];
            $currentcambiar->id = $row['ID_cambiar'];
            $currentcambiar->vigencia = $row['vigencia'];
            return $currentcambiar;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($cambiar) {
        $sql = "UPDATE cambiar SET Correo = '" . $cambiar['correo'] . "', Telefono = '" . $cambiar['telefono'] . "', Domicilio = '" . $cambiar['domicilio'] . "', Nombre = '" . $cambiar['nombre'] . "' WHERE ID_cambiar LIKE " . (int) $cambiar['id'];
        $this->db->connect()->query($sql);
        return $this->getcambiarID($cambiar['id']);
    }

    function new($cambiar) {
        try {
            $sql = "INSERT INTO `cambiar`(`Nombre`, `Telefono`) VALUES ('" . $cambiar['nombre'] . "','" . $cambiar['telefono'] . "')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($cambiarID) {
        try {
            $sql = "UPDATE cambiar SET vigencia = 'false' WHERE ID_cambiar LIKE " . (int) $cambiarID;
            $this->db->connect()->query($sql);
            return 'cambiar borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    function restore($cambiarID){
        try {
            $sql = "UPDATE cambiar SET vigencia = 'true' WHERE ID_cambiar LIKE " . (int) $cambiarID;
            $this->db->connect()->query($sql);
            return $this->getcambiarID($cambiarID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectcambiar();
        }
    }

}

//la tabla quedaria mal escrita ya que esta en plural