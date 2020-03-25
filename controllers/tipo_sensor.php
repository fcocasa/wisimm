<?php

class tipo_sensor extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        $this->loadExternalModel('atributo');
        //echo 'construyo tipoSensor';
    }

    function render() {
        // echo 'redirect tipoSensor';
        $this->view->datos = $this->model->getEveryTipo_Sensor();
        //echo $this->dato
        $this->view->render('tipo_sensor/index');
    }

    function consulta() {
        $tipoSensor = isset($_POST['nombre_tipo_sensor']) ? $_POST['nombre_tipo_sensor'] : null;
        if ($tipoSensor === null || $tipoSensor === '') {
            $this->view->datos = $this->model->getEveryTipo_Sensor();
            //echo $this->dato
            $this->view->render('tipo_sensor/index');
        } else {
            $this->view->datos = $this->model->getTipo_Sensor($tipo_sensor);
            //echo $this->dato
            $this->view->render('tipo_sensor/index');
        }
    }

    function perfil() {
        $tipo_sensorID = isset($_POST['id']) ? $_POST['id'] : null;
        if ($tipo_sensorID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->attributes = $this->model_atributo->getAttFromTipoSensor($tipo_sensorID);
            $this->view->tipoSensor = $this->model->getTipo_SensorID($tipo_sensorID);
            $this->view->render('tipo_sensor/perfil');
        }
    }

    function modificar() {
        $tipo_sensorID = isset($_POST['id']) ? $_POST['id'] : null;
        // echo $_POST['tipo'];
        if ($tipo_sensorID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $tipo_sensor = array("id" => $_POST['id'],"version" => $_POST['version'], "nombre" => $_POST['nombre']);
                $valores = $_POST["valores"];
                $valoresID = $_POST["valoresID"];
                //echo 'hola';
                //print_r($valores);
                //print_r($tipoSensor);
                $this->model_atributo->modifyValueAttr($tipo_sensorID, $valoresID, $valores);
                $this->view->tipoSensor = $this->model->modify($tipo_sensor);
                $this->view->attributes = $this->model_atributo->getAttFromTipoSensor($tipo_sensorID);
                $this->view->message = 'tipo_sensor modificado con exito';
                $this->view->render('tipo_sensor/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($tipo_sensorID);
                $this->view->tipoSensor = new objectTipo_Sensor();
                $this->view->render('tipo_sensor/perfil');
            } else {
                $this->view->tipoSensor = $this->model->restore($tipo_sensorID);
                $this->view->message = 'Tipo_Sensor recuperado con exito';
                $this->view->render('tipo_sensor/perfil');
            }
        }
    }

    function nuevo() {
        
        $this->view->attributes = $this->model_atributo->getEveryAttribute();
        //print_r($this->view->attributes);
        if (!isset($_POST['nombre'])) {
            //echo 'pagina nuevo tipoSensor';
            $this->view->render('tipo_sensor/nuevo');
        } else {
            $tipoSensor = $_POST['nombre'];
            $version = $_POST['version'];
            $attributes = $_POST['attribute'];
            //echo $_POST['nombre'];
            $creado = $this->model->new($tipoSensor, $attributes, $version);
            if ($creado) {
                $this->view->message = 'Tipo_Sensor "' . $_POST['nombre'] . '" creado con exito';
            } else {
                $this->view->message = 'Tipo_Sensor no creado, ocurrio un error';
            }
            $this->view->render('tipo_sensor/nuevo');
        }
    }

}
