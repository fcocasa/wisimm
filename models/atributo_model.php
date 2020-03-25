<?php

class atributo_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryAttribute() {
        try {
            if (isset($_POST['buscar'])) {
                $sql = "SELECT*FROM atributos";
            } else {
                $sql = "SELECT*FROM atributos WHERE vigencia like 'true' ";
            }

            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentAtributo = new objectAttribute();
                $currentAtributo->nombre = $row['Atributo'];
                //echo $row['Nombre'];
                $currentAtributo->id = $row['ID_Atributo'];
                $currentAtributo->vigencia = $row['vigencia'];
                array_push($items, $currentAtributo);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getAttribute($atributo) {
        try {
            $sql = "SELECT * FROM `atributos` WHERE Atributo LIKE '%" . $atributo . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentAtributo = new objectAttribute();
                $currentAtributo->nombre = $row['Atributo'];
                //echo $row['Nombre'];
                $currentAtributo->id = $row['ID_Atributo'];
                $currentAtributo->vigencia = $row['vigencia'];
                array_push($items, $currentAtributo);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getAttributeID($atributoID) {
        try {
            $int = (int) $atributoID;
            $sql = "SELECT * FROM `atributos` WHERE ID_Atributo LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentAtributo = new objectAttribute();
            $currentAtributo->nombre = $row['Atributo'];
            //echo $row['Nombre'];
            $currentAtributo->id = $row['ID_Atributo'];
            $currentAtributo->vigencia = $row['vigencia'];
            return $currentAtributo;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($atributo) {
        
        $sql = "UPDATE atributos SET Atributo = '" . $atributo['nombre'] . "' WHERE ID_Atributo LIKE " . (int) $atributo['id'];
        $this->db->connect()->query($sql);
        return $this->getAttributeID($atributo['id']);
    }

    function new($atributo) {
        try {
            //echo $atributo;
            $sql = "INSERT INTO `atributos`(`Atributo`, `vigencia`) VALUES ('" .$atributo. "','true')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($atributoID) {
        try {
            $sql = "UPDATE atributos SET vigencia = 'false' WHERE ID_Atributo LIKE " . (int) $atributoID;
            $this->db->connect()->query($sql);
            return 'Atributo borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function restore($atributoID) {
        try {
            $sql = "UPDATE atributos SET vigencia = 'true' WHERE ID_Atributo LIKE " . (int) $atributoID;
            $this->db->connect()->query($sql);
            return $this->getAttributeID($atributoID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectAttribute();
        }
    }
    
    function getAttFromTipoSensor($idTipoSensor){
        $sql = "SELECT * FROM `valores` WHERE `ID_Tipo_Sensor` LIKE ".$idTipoSensor;
        $idsAtt = $this->db->connect()->query($sql);
        $items = [];
        //print_r($idsAtt);
        while ($row = $idsAtt->fetch()) {
            $item = $this->getAttributeID($row['ID_Atributo']);
            $item->valor = $row['valor'];
            array_push($items,$item); 
        }
        //print_r($items);
        return $items;
    }

}
