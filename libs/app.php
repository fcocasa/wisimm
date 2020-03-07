<?php

class app {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        //print_r($url);// $url . '<br>';
        $url = rtrim($url, '/');
        //var_dump($url);//echo $url . '<br>';
        $url = explode('/', $url);
        //print_r($url);
        if (empty($url[0])) {
            //echo 'vacio';
            require_once 'controllers/main.php';
            $controller = new main();
        } else {
            $archivoController = $url['0'];
            //echo $archivoController;
            if (file_exists('controllers/' . $archivoController . '.php')) { //dire controllers/fran.php
                require_once 'controllers/' . $archivoController . '.php';
                //echo 'controllers/'.$archivoController.'.php';
                $controller = new $archivoController;
                $controller->loadModel($archivoController);
                if (empty($url[1])) {
                    $controller->render();
                } else {
                    $controller -> {$url[1]}();
                }
            } else {
                echo '404 Pagina no encontrada'.' no existe: ' . $archivoController . '.php';
            }
        }
    }

}
