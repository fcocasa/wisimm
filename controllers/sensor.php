<?php

class sensor extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        //echo 'construyo sensor';
    }

    function render() {
        // echo 'redirect sensor';
        $this->view->datos = $this->model->getEverySensor();
        //echo $this->dato
        $this->view->render('sensor/index');
    }

    function consulta() {
        $sensor = isset($_POST['nombre_sensor']) ? $_POST['nombre_sensor'] : null;
        if ($sensor === null || $sensor === '') {
            $this->view->datos = $this->model->getEverySensor();
            //echo $this->dato
            $this->view->render('sensor/index');
        } else {
            $this->view->datos = $this->model->getSensor($sensor);
            //echo $this->dato
            $this->view->render('sensor/index');
        }
    }

    function perfil() {
        $sensorID = isset($_POST['id_sensor']) ? $_POST['id_sensor'] : null;
        if ($sensorID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->sensor = $this->model->getSensorID($sensorID);
            $this->view->render('sensor/perfil');
        }
    }

    function modificar() {
        $sensorID = isset($_POST['id']) ? $_POST['id'] : null;
        // echo $_POST['tipo'];
        if ($sensorID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $sensor = array("id_sensor" => $_POST['id_sensor'], "id_tipo_sensor" => $_POST['id_tipo_sensor']);
                //print_r($sensor);
                $this->view->sensor = $this->model->modify($sensor);
                $this->view->message = 'Sensor modificado con exito';
                $this->view->render('sensor/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($sensorID);
                $this->view->sensor = new objectSensor();
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
            echo $sensor;
            $creado = $this->model->new($sensor);
            if ($creado) {
                $this->view->message = 'Sensor "' . $_POST['nombre_sensor'] . '" creado con exito';
            } else {
                $this->view->message = 'Sensor no creado, ocurrio un error';
            }
            $this->view->render('sensor/nuevo');
        }
    }

}
