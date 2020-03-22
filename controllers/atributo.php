<?php

class atributo extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        //echo 'construyo atributo';
    }

    function render() {
        // echo 'redirect atributo';
        $this->view->datos = $this->model->getEveryAttribute();
        //echo $this->dato
        $this->view->render('atributo/index');
    }

    function consulta() {
        $atributo = isset($_POST['nombre_atributo']) ? $_POST['nombre_atributo'] : null;
        if ($atributo === null || $atributo === '') {
            $this->view->datos = $this->model->getEveryAttribute();
            //echo $this->dato
            $this->view->render('atributo/index');
        } else {
            $this->view->datos = $this->model->getAttribute($atributo);
            //echo $this->dato
            $this->view->render('atributo/index');
        }
    }

    function perfil() {
        $atributoID = isset($_POST['id']) ? $_POST['id'] : null;
        if ($atributoID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->atributo = $this->model->getAttributeID($atributoID);
            $this->view->render('atributo/perfil');
        }
    }

    function modificar() {
        $atributoID = isset($_POST['id']) ? $_POST['id'] : null;
        // echo $_POST['tipo'];
        if ($atributoID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $atributo = array("id" => $_POST['id'], "nombre" => $_POST['nombre']);
                //print_r($atributo);
                $this->view->atributo = $this->model->modify($atributo);
                $this->view->message = 'Atributo modificado con exito';
                $this->view->render('atributo/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($atributoID);
                $this->view->atributo = new objectAttribute();
                $this->view->render('atributo/perfil');
            } else {
                $this->view->atributo = $this->model->restore($atributoID);
                $this->view->message = 'Atributo recuperado con exito';
                $this->view->render('atributo/perfil');
            }
        }
    }

    function nuevo() {
        if (!isset($_POST['nombre'])) {
            //echo 'pagina nuevo atributo';
            $this->view->render('atributo/nuevo');
        } else {
            $atributo = $_POST['nombre'];
            //echo $_POST['nombre'];
            $creado = $this->model->new($atributo);
            if ($creado) {
                $this->view->message = 'Atributo "' . $_POST['nombre'] . '" creado con exito';
            } else {
                $this->view->message = 'Atributo no creado, ocurrio un error';
            }
            $this->view->render('atributo/nuevo');
        }
    }

}
