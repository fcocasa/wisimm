<?php

class tipo_sensor_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryTipo_Sensor() {
        try {
            if (isset($_POST['buscar'])) {
                $sql = "SELECT*FROM tipo_sensores";
            } else {
                $sql = "SELECT*FROM tipo_sensores WHERE vigencia like 'true' ";
            }

            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentTipo_Sensor = new objectTipo_Sensor();
                $currentTipo_Sensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
                //echo $row['Nombre'];
                $currentTipo_Sensor->nombre = $row['Tipo_Sensor'];
                $currentTipo_Sensor->version = $row['version'];
                $currentTipo_Sensor->vigencia = $row['vigencia'];
                array_push($items, $currentTipo_Sensor);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getTipo_Sensor($tipo_sensor) {
        try {
            $sql = "SELECT * FROM `tipo_sensores` WHERE Tipo_Sensor LIKE '%" . $tipo_sensor . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentTipo_Sensor = new objectTipo_Sensor();
                $currentTipo_Sensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
                //echo $row['Nombre'];
                $currentTipo_Sensor->nombre = $row['Tipo_Sensor'];
                $currentTipo_Sensor->version = $row['version'];
                $currentTipo_Sensor->vigencia = $row['vigencia'];
                array_push($items, $currentTipo_Sensor);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getTipo_SensorID($tipo_sensorID) {
        try {
            $int = (int) $tipo_sensorID;
            $sql = "SELECT * FROM `tipo_sensores` WHERE ID_Tipo_Sensor LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentTipo_Sensor = new objectTipo_Sensor();
            $currentTipo_Sensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
                //echo $row['Nombre'];
                $currentTipo_Sensor->nombre = $row['Tipo_Sensor'];
                $currentTipo_Sensor->version = $row['version'];
                $currentTipo_Sensor->vigencia = $row['vigencia'];
            return $currentTipo_Sensor;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($tipo_sensor) {
        
        $sql = "UPDATE tipo_sensores SET Tipo_Sensor = '" . $tipo_sensor['nombre'] . "' WHERE ID_Tipo_Sensor LIKE " . (int) $tipo_sensor['id_tipo_sensor'];
        $this->db->connect()->query($sql);
        return $this->getTipo_SensorID($tipo_sensor['id_tipo_sensor']);
    }

    function new($tipo_sensor) {
        try {
            //echo $tipo_sensor;
            $sql = "INSERT INTO `tipo_sensores`(`Atributo`, `vigencia`) VALUES ('" .$tipo_sensor. "','true')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($tipo_sensorID) {
        try {
            $sql = "UPDATE tipo_sensores SET vigencia = 'false' WHERE ID_Tipo_Sensor LIKE " . (int) $tipo_sensorID;
            $this->db->connect()->query($sql);
            return 'Tipo Sensor borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function restore($tipo_sensorID) {
        try {
            $sql = "UPDATE tipo_sensores SET vigencia = 'true' WHERE ID_Tipo_Sensor LIKE " . (int) $tipo_sensorID;
            $this->db->connect()->query($sql);
            return $this->getTipo_SensorID($tipo_sensorID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectTipo_Sensor();
        }
    }

}
