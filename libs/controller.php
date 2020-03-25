<?php

class controller{
    
    function __contruct(){
        //echo "controlador base";
        $this->view = new view();
    }
    function loadModel($model){
        $url = 'models/'.$model. '_model.php';
        //echo $url;
        if(file_exists($url)){
            require_once $url;
            
            $modelName= $model.'_model';
            $this->model = new $modelName(); //con esto estoy mandando a llamar al modelo
        }
    }
    function loadExternalModel($model){
        require_once 'controllers/'.$model.'.php';
        $nomreController = 'controller_'.$model;
        $this->$nomreController= new $model;
        $url = 'models/'.$model. '_model.php';
        //echo $url;
        if(file_exists($url)){
            require_once $url;
            
            $modelName= $model.'_model';
            $NombreModelo = 'model_'.$model;
            $this->$NombreModelo = new $modelName(); //con esto estoy mandando a llamar al modelo
            //echo $NombreModelo;
        }
    }
}