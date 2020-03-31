<?php

class sensor extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        $this->view->nombreTipoSensor = [];
        //echo 'construyo sensor';
        $this->loadExternalModel('tipo_sensor');
    }

    function render() {
        // echo 'redirect sensor';
        $this->view->datos = $this->model->getEverySensor();
        $this->view->nombreTipoSensor = $this->model->getEveryNombreSensor();
      //  foreach ($this->view->datos as $key => $value) {
        //    $value->nombre_tipo_sensor = $this->model_tipo_sensor->getTipo_SensorID($value->id_tipo_sensor)->nombre;
        //}
        $this->view->render('sensor/index');
    }

    function consulta() {
        $sensor = isset($_POST['nombre_sensor']) ? $_POST['nombre_sensor'] : null;
        if ($sensor === null || $sensor === '') {
            $this->view->datos = $this->model->getEverySensor();
            $this->view->nombreTipoSensor = $this->model->getEveryNombreSensor();
            $this->view->render('sensor/index');
            echo 'estoy aca';
        } else {
            $this->view->datos = $this->model->getSensor($sensor);
            echo datos;  //ver como se imprime en este casoooo necesito sacar de datos el id del sensor para usar la funcion ger nombre sensor
            $this->view->render('sensor/index');
        }
    }

    function perfil() {
        $sensorID = isset($_POST['id_sensor']) ? $_POST['id_sensor'] : null;
        $idTipoSensor = isset($_POST['id_tipo_sensor']) ? $_POST['id_tipo_sensor'] : null;
       
        if ($sensorID === null) {
            echo 'algo salio mal';
        } else {
           //  print_r($idTipoSensor);
            $this->view->sensor = $this->model->getSensorID($sensorID);
            //$this->view->nombreTipoSensor = $this->model->getNombreSensorID($idTipoSensor);
          // print_r($this->view->nombreTipoSensor) ;
            $this->view->render('sensor/perfil');
        }
    }

    function modificar() {
        $sensorID = isset($_POST['id_sensor']) ? $_POST['id_sensor'] : null;
       // $idTipoSensor = isset($_POST['id_tipo_sensor']) ? $_POST['id_tipo_sensor'] : null;
        // echo $_POST['tipo'];
        if ($sensorID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $sensor = array("id_sensor" => $_POST['id_sensor'],"id_tipo_sensor" => $_POST['id_tipo_sensor']);
                $this->view->sensor = $this->model->modify($sensor);
               // $this->view->nombreTipoSensor = $this->model_tipo_sensor->getNombreTipoSensorFromTipoSensor($sensorID);
                $this->view->message = 'sensor modificado con exito';
                $this->view->render('sensor/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($sensorID);
                $this->view->sensor = new objectSensorLITE();
                $this->view->render('sensor/perfil');
            } else {
                $this->view->sensor = $this->model->restore($sensorID);
                $this->view->message = 'Sensor recuperado con exito';
                $this->view->render('sensor/perfil');
            }
        }
    }
      


    function nuevo() {
        //echo $_POST['nuevo_sensor'];
        if (!isset($_POST['nuevo_sensor'])) {
            //echo 'pagina nuevo sensor';
            $this->view->render('sensor/nuevo');
        } else {
            $sensor = $_POST['nuevo_sensor'];
            $tipoSensor = $_POST['Tipo_Sensor'];
            //echo $sensor;
            $creado = $this->model->new($sensor, $tipoSensor);
            
            if ($creado) {
                $this->view->message = 'Sensor "' . $_POST['nuevo_sensor'] . '" creado con exito';
            } else {
                $this->view->message = 'Sensor no creado, ocurrio un error';
            }
            $this->view->render('sensor/nuevo');
        }
    }

}
