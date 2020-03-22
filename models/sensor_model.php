<?php

class sensor_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEverySensor() {
        try {
            if (isset($_POST['buscar'])) {
                $sql = "SELECT*FROM sensores";
            } else {
                $sql = "SELECT*FROM sensores WHERE vigencia like 'true' ";
            }

            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentSensor = new objectSensor();
                $currentSensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
                //echo $row['Nombre'];
                $currentSensor->id_sensor = $row['ID_Sensor'];
                $currentSensor->vigencia = $row['vigencia'];
                array_push($items, $currentSensor);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getSensor($sensor) {
        try {
            $sql = "SELECT * FROM `sensors` WHERE Atributo LIKE '%" . $sensor . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentSensor = new objectSensor();
                $currentSensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
                //echo $row['Nombre'];
                $currentSensor->id_sensor = $row['ID_Sensor'];
                $currentSensor->vigencia = $row['vigencia'];
                array_push($items, $currentSensor);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getSensorID($sensorID) {
        try {
            $int = (int) $sensorID;
            $sql = "SELECT * FROM `sensores` WHERE ID_Sensor LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['Atributo'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentSensor = new objectSensor();
            $currentSensor->id_tipo_sensor = $row['ID_Tipo_Sensor'];
            //echo $row['Nombre'];
            $currentSensor->id_sensor = $row['ID_Sensor'];
            $currentSensor->vigencia = $row['vigencia'];
            return $currentSensor;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($sensor) {
        $sql = "UPDATE sensores SET ID_Tipo_Sensor = '" .(int) $sensor['id_tipo_sensor'] . "' WHERE ID_Sensor LIKE " . (int) $sensor['id_sensor'];
        $this->db->connect()->query($sql);
        return $this->getSensorID($sensor['id_sensor']);
    }

    function new($sensor) {
        try {
            $sql = "INSERT INTO `sensores`(`ID_Tipo_Sensor`, `vigencia`) VALUES ('" . (int)$sensor. "','true')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($sensorID) {
        try {
            $sql = "UPDATE sensores SET vigencia = 'false' WHERE ID_Sensor LIKE " . (int) $sensorID;
            $this->db->connect()->query($sql);
            return 'Sensor borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function restore($sensorID) {
        try {
            $sql = "UPDATE sensores SET vigencia = 'true' WHERE ID_Sensor LIKE " . (int) $sensorID;
            $this->db->connect()->query($sql);
            return $this->getSensorID($sensorID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectSensor();
        }
    }

}
