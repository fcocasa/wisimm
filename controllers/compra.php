<?php

class compra extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        //echo 'construyo compra';
    }

    function render() {
        // echo 'redirect compra';
        $this->view->datos = $this->model->getEveryCompra();
        //echo $this->dato
        $this->view->render('compra/index');
    }

    function consulta() {
        $compra = isset($_POST['nombre_compra']) ? $_POST['nombre_compra'] : null;
        if ($compra === null || $compra === '') {
            $this->view->datos = $this->model->getEveryCompra();
            //echo $this->dato
            $this->view->render('compra/index');
        } else {
            $this->view->datos = $this->model->getCompra($compra);
            //echo $this->dato
            $this->view->render('compra/index');
        }
    }

    function perfil() {
        $compraID = isset($_POST['id_compra']) ? $_POST['id_compra'] : null;
        if ($compraID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->compra = $this->model->getCompraID($compraID);
            $this->view->render('compra/perfil');
        }
    }

    function modificar() {
        $compraID = isset($_POST['id_compra']) ? $_POST['id_compra'] : null;
        // echo $_POST['tipo'];
        if ($compraID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $compra = array("id_compra" => $_POST['id_compra'], "id_cliente" => $_POST['id_cliente'], "id_sensor" => $_POST['id_sensor'], "fecha" => $_POST['fecha']);
                //print_r($compra);
                $this->view->compra = $this->model->modify($compra);
                $this->view->message = 'Compra modificado con exito';
                $this->view->render('compra/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($compraID);
                $this->view->compra = new objectCompra();
                $this->view->render('compra/perfil');
            } else {
                $this->view->compra = $this->model->restore($compraID);
                $this->view->message = 'Compra recuperado con exito';
                $this->view->render('compra/perfil');
            }
        }
    }

    function nuevo() {
        if (!isset($_POST['id_cliente']) || !isset($_POST['id_sensor']) || !isset($_POST['fecha'])  || !isset($_POST['id_compra']) ) {
            //echo 'pagina nuevo compra';
            $this->view->render('compra/nuevo');
        } else {
            $compra = array("id_cliente" => $_POST['id_cliente'],"id_compra" => $_POST['id_compra'], "id_sensor" => $_POST['id_sensor'], "fecha" => $_POST['fecha']);
            $creado = $this->model->new($compra);
            if ($creado) {
                $this->view->message = 'Compra "' . $_POST['id_compra'] . '" creado con exito';
            } else {
                $this->view->message = 'Compra no creado, ocurrio un error';
            }
            $this->view->render('compra/nuevo');
        }
    }

}
