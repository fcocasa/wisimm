<?php

class sensor_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEverySensor() {
        try {
            if (isset($_POST['buscar'])) {
                $sql_1 = "SELECT*FROM sensores";
            } else {
                $sql_1 = "SELECT*FROM sensores WHERE vigencia like 'true' ";
            }

            $result_1 = $this->db->connect()->query($sql_1);
            // $result_2 = $this->db->connect()->query("SELECT*FROM tipo_sensores WHERE vigencia like 'true'");
            $items = [];
            while ($row_1 = $result_1->fetch()) {
                $sql_3 = "SELECT*FROM tipo_sensores WHERE ID_Tipo_Sensor LIKE " . $row_1['ID_Tipo_Sensor'];
                $row_3 = $this->db->connect()->query($sql_3)->fetch();
                $currentSensor = new objectSensorLITE();
                //print_r($row_3);
                $currentSensor->nombre_tipo_sensor = $row_3['Tipo_Sensor'];
                //echo $currentSensor->nombre_tipo_sensor." ";
                $currentSensor->id_tipo_sensor = $row_1['ID_Tipo_Sensor'];
                //echo $currentSensor->id_tipo_sensor;
                //$row_2= $result_2->fetch();
                //$currentSensor->nombre_tipo_sensor = getNombreTipoSensorFromTipoSensor($row_1['ID_Tipo_Sensor']);
                $currentSensor->id_sensor = $row_1['ID_Sensor'];
                $currentSensor->vigencia = $row_1['vigencia'];
                //print_r($currentSensor);
                array_push($items, $currentSensor);
            }


            return $items;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    function getEveryNombreSensor() {
        try {
            if (isset($_POST['buscar'])) {
                $sql_1 = "SELECT*FROM tipo_sensores";
            } else {
                $sql_1 = "SELECT*FROM tipo_sensores WHERE vigencia like 'true' ";
            }

            $result_1 = $this->db->connect()->query($sql_1);
            // $result_2 = $this->db->connect()->query("SELECT*FROM tipo_sensores WHERE vigencia like 'true'");
            $items = [];
            while ($row_1 = $result_1->fetch()) {
                $currentSensor = new objectSensorLITE();
                $currentSensor->nombre_tipo_sensor = $row_1['Tipo_Sensor'];
                $currentSensor->vigencia = $row_1['vigencia'];
                array_push($items, $currentSensor);
            } return $items;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    function getSensor($sensor) {
        try {
            //$int = (int) $sensor;
            $sql_1 = "SELECT * FROM `sensores` WHERE ID_Sensor LIKE '%" . $sensor . "%' and vigencia like 'true'";
            $result_1 = $this->db->connect()->query($sql_1);
            $items = [];
            while ($row_1 = $result_1->fetch()) {
                $sql_3 = "SELECT*FROM tipo_sensores WHERE ID_Tipo_Sensor LIKE " . $row_1['ID_Tipo_Sensor'];
                $row_3 = $this->db->connect()->query($sql_3)->fetch();
                $currentSensor = new objectSensorLITE();
                $currentSensor->id_tipo_sensor = $row_1['ID_Tipo_Sensor'];
                // $row_2=$result_2->fetch();
                $currentSensor->nombre_tipo_sensor = $row_3['Tipo_Sensor'];
                $currentSensor->id_sensor = $row_1['ID_Sensor'];
                $currentSensor->vigencia = $row_1['vigencia'];
                array_push($items, $currentSensor);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getNombreSensor($idsensor) {
        try {
            //$int = (int) $sensor;
            $sql_2 = "SELECT * FROM `tipo_sensores` WHERE ID_Tipo_Sensor LIKE '%" . (int) $idsensor . "%' and vigencia like 'true'";
            $result_2 = $this->db->connect()->query($sql_2);
            $items = [];
            $currentSensor = new objectSensorLITE();
            while ($row_2 = $result_2->fetch()) {
                $currentSensor->nombre_tipo_sensor = $row_2['Tipo_Sensor'];
                $currentSensor->vigencia = $row_2['vigencia'];
                array_push($items, $currentSensor);
            }return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getSensorID($sensorID) {
        try {
            $result_1 = $this->db->connect()->query("SELECT * FROM `sensores` WHERE ID_Sensor LIKE '" . $sensorID . "'");
            $row_1 = $result_1->fetch();
            //print_r($row);
            $currentSensor = new objectSensorLITE();
            $currentSensor->id_tipo_sensor = $row_1['ID_Tipo_Sensor'];
            //$row_2=$result_2->fetch();
            //$currentSensor->nombre_tipo_sensor = $row_2[$currentSensor->id_tipo_sensor];
            $currentSensor->id_sensor = $row_1['ID_Sensor'];
            $currentSensor->vigencia = $row_1['vigencia'];
            return $currentSensor;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getNombreSensorID($tiposensorID) {
        try {
            $int = (int) $tiposensorID;
            $result_2 = $this->db->connect()->query("SELECT * FROM `tipo_sensores` WHERE ID_Tipo_Sensor LIKE '" . $int . "'");
            $row_2 = $result_2->fetch();

            print_r($row_2);
            $currentSensor = new objectSensorLITE();
            $currentSensor->nombre_tipo_sensor = $row_2['Tipo_Sensor'];

            // print_r($currentSensor->nombre_tipo_sensor);
            $currentSensor->vigencia = $row_2['vigencia'];
            return $currentSensor;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($sensor) {
        $sql = "UPDATE sensores SET ID_Tipo_Sensor = '" . $sensor['id_tipo_sensor'] . "' WHERE ID_Sensor LIKE " . (int) $sensor['id_sensor'];
        $this->db->connect()->query($sql);
        return $this->getSensorID($sensor['id_sensor']);
    }

    function new($sensorID, $tipo_sensorID) {
        try {
            $sql = "INSERT INTO `sensores`(`ID_Sensor`, `ID_Tipo_Sensor`, `vigencia`) VALUES ('" . $sensorID . "', '" . $tipo_sensorID . "' ,'true')";
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
            $sql = "UPDATE sensores SET vigencia = 'false' WHERE ID_Sensor LIKE " . $sensorID;
            $this->db->connect()->query($sql);
            return 'Sensor borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function restore($sensorID) {
        try {
            $sql = "UPDATE sensores SET vigencia = 'true' WHERE ID_Sensor LIKE " . $sensorID;
            $this->db->connect()->query($sql);
            return $this->getSensorID($sensorID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectSensorLITE();
        }
    }

}
