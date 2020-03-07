<?php

class view {

    function __construct() {
        //echo 'se creo view';
    }

    function render($str) {
        //echo "render";
        if (file_exists('views/' . $str . '.php')) {
            require_once 'views/' . $str . '.php';
        } else {
            require_once '';
        }
    }

}
