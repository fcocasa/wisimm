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
        if ($cliente === null || $cliente === '') {
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

    function modificar() {
        $clienteID = isset($_POST['id']) ? $_POST['id'] : null;
        // echo $_POST['tipo'];
        if ($clienteID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $cliente = array("id" => $_POST['id'], "nombre" => $_POST['nombre'], "telefono" => $_POST['telefono'], "correo" => $_POST['correo'], "domicilio" => $_POST['domicilio']);
                //print_r($cliente);
                $this->view->cliente = $this->model->modify($cliente);
                $this->view->message = 'Cliente modificado con exito';
                $this->view->render('cliente/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($clienteID);
                $this->view->cliente = new objectCliente();
                $this->view->render('cliente/perfil');
            } else {
                $this->view->cliente = $this->model->restore($clienteID);
                $this->view->message = 'Cliente recuperado con exito';
                $this->view->render('cliente/perfil');
            }
        }
    }

    function nuevo() {
        if (!isset($_POST['nombre']) || !isset($_POST['nombre']) || !isset($_POST['nombre']) || !isset($_POST['nombre'])) {
            //echo 'pagina nuevo cliente';
            $this->view->render('cliente/nuevo');
        } else {
            $cliente = array("nombre" => $_POST['nombre'], "telefono" => $_POST['telefono'], "correo" => $_POST['correo'], "domicilio" => $_POST['domicilio']);
            $creado = $this->model->new($cliente);
            if ($creado) {
                $this->view->message = 'Cliente "' . $_POST['nombre'] . '" creado con exito';
            } else {
                $this->view->message = 'Cliente no creado, ocurrio un error';
            }
            $this->view->render('cliente/nuevo');
        }
    }

}
