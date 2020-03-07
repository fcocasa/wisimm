<?php

class cliente extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        //echo 'construyo cliente';
    }

    function render() {
        // echo 'redirect cliente';
        $this->view->datos = $this->model->getEveryClient();
        //echo $this->dato
        $this->view->render('cliente/index');
    }

    function consulta() {
        $cliente = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente'] : null;
        if ($cliente === null) {
            $this->view->datos = $this->model->getEveryClient();
            //echo $this->dato
            $this->view->render('cliente/index');
        } else {
            $this->view->datos = $this->model->getClient($cliente);
            //echo $this->dato
            $this->view->render('cliente/index');
        }
    }

    function perfil() {
        $clienteID = isset($_POST['id']) ? $_POST['id'] : null;
        if ($clienteID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->cliente = $this->model->getClientID($clienteID);
            $this->view->render('cliente/perfil');
        }
    }
    
    function modificar(){
        $clienteID = isset($_POST['id'])?$_POST['id']:null;
        if($clienteID === null){
            $this->view->render('error');
        } else {
            $cliente = array("id" => $_POST['id'],"nombre" => $_POST['nombre'], "telefono" => $_POST['telefono'], "correo" => $_POST['correo'], "domicilio" => $_POST['domicilio']);
            //print_r($cliente);
            $this->view->cliente = $this->model->modify($cliente);
            $this->view->render('cliente/perfil');
        }
    }

}
