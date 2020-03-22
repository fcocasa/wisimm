<?php

class cambiar extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->datos = [];
        //echo 'construyo cambiar';
    }

    function render() {
        // echo 'redirect cambiar';
        $this->view->datos = $this->model->getEverycambiar();
        //echo $this->dato
        $this->view->render('cambiar/index');
    }

    function consulta() {
        $cambiar = isset($_POST['nombre_cambiar']) ? $_POST['nombre_cambiar'] : null;
        if ($cambiar === null || $cambiar === '') {
            $this->view->datos = $this->model->getEverycambiar();
            //echo $this->dato
            $this->view->render('cambiar/index');
        } else {
            $this->view->datos = $this->model->getcambiar($cambiar);
            //echo $this->dato
            $this->view->render('cambiar/index');
        }
    }

    function perfil() {
        $cambiarID = isset($_POST['id']) ? $_POST['id'] : null;
        if ($cambiarID === null) {
            echo 'algo salio mal';
        } else {
            $this->view->cambiar = $this->model->getcambiarID($cambiarID);
            $this->view->render('cambiar/perfil');
        }
    }

    function modificar() {
        $cambiarID = isset($_POST['id']) ? $_POST['id'] : null;
        // echo $_POST['tipo'];
        if ($cambiarID === null) {
            $this->view->render('error');
        } else {
            if ($_POST['tipo'] === 'modificar') {
                $cambiar = array("id" => $_POST['id'], "nombre" => $_POST['nombre'], "telefono" => $_POST['telefono'], "correo" => $_POST['correo'], "domicilio" => $_POST['domicilio']);
                //print_r($cambiar);
                $this->view->cambiar = $this->model->modify($cambiar);
                $this->view->message = 'cambiar modificado con exito';
                $this->view->render('cambiar/perfil');
            } else if ($_POST['tipo'] === 'eliminar') {
                $this->view->message = $this->model->delete($cambiarID);
                $this->view->cambiar = new objectcambiar();
                $this->view->render('cambiar/perfil');
            } else {
                $this->view->cambiar = $this->model->restore($cambiarID);
                $this->view->message = 'cambiar recuperado con exito';
                $this->view->render('cambiar/perfil');
            }
        }
    }

    function nuevo() {
        if (!isset($_POST['nombre']) || !isset($_POST['nombre']) || !isset($_POST['nombre']) || !isset($_POST['nombre'])) {
            //echo 'pagina nuevo cambiar';
            $this->view->render('cambiar/nuevo');
        } else {
            $cambiar = array("nombre" => $_POST['nombre'], "telefono" => $_POST['telefono'], "correo" => $_POST['correo'], "domicilio" => $_POST['domicilio']);
            $creado = $this->model->new($cambiar);
            if ($creado) {
                $this->view->message = 'cambiar "' . $_POST['nombre'] . '" creado con exito';
            } else {
                $this->view->message = 'cambiar no creado, ocurrio un error';
            }
            $this->view->render('cambiar/nuevo');
        }
    }

}
