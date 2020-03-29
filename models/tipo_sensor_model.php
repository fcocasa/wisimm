<?php

class tipo_sensor_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryTipo_Sensor() {
        //echo 'llegue';
        try {
            //echo 'llegue-------------------------------------';
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
               // echo $row['ID_Tipo_Sensor'];
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
        
        $sql = "UPDATE tipo_sensores SET Tipo_Sensor = '" . $tipo_sensor['nombre'] . "', version = '" . $tipo_sensor['version'] . "' WHERE ID_Tipo_Sensor LIKE " . (int) $tipo_sensor['id'];
        $this->db->connect()->query($sql);
        return $this->getTipo_SensorID($tipo_sensor['id']);
    }

    function new($tipo_sensor, $atributtes, $version) {
        try {
            //echo $tipo_sensor;
            $sql = "INSERT INTO `tipo_sensores`(`Tipo_Sensor`,`version`) VALUES ('" .$tipo_sensor. "','" .$version. "')";
             //echo $sql;
            $this->db->connect()->query($sql);
            $idTipoSensor =  $this->db->connect()->query("SELECT MAX(`ID_Tipo_Sensor`) FROM tipo_sensores")->fetch();
           // print((int)$idTipoSensor);
            foreach ($atributtes as $key => $value) {
                 $sql = "INSERT INTO `valores`(`ID_Tipo_Sensor`,`ID_Atributo`) VALUES ('" .$idTipoSensor[0]. "','" .(int)$value. "')";
                 $this->db->connect()->query($sql);
            }
           
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
    
     function getNombreTipoSensorFromTipoSensor($idTipoSensor) {
        $sql = "SELECT * FROM `tipo_sensores` WHERE `ID_Tipo_Sensor` LIKE " . $idTipoSensor;
        $idSen = $this->db->connect()->query($sql);
        $items = [];
        print_r($idSen);
        while ($row = $idSen->fetch()) {
            $item = $this->getTipo_SensorID($row['ID_Tipo_Sensor']);
            $item->valor = $row['Tipo_Sensor'];
            array_push($items, $item);
        }
        //print_r($items);
        return $items;
     }
     
    
    

}
