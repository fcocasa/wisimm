<?php

class view {

    function __construct() {
        //echo 'se creo view';
        $this->message = null;
    }

    function render($str) {
        //echo "render";
        if (file_exists('views/' . $str . '.php')) {
            require_once 'views/' . $str . '.php';
        } else {
            echo '404 Pagina no encontrada' .$str . '.php';
        }
    }

}
