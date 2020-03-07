<?php

class controller{
    
    function __contruct(){
        //echo "controlador base";
        $this->view = new view();
    }
    function loadModel($model){
        $url = 'models/'.$model. '_model.php';
        
        if(file_exists($url)){
            require_once $url;
            
            $modelName= $model.'_model';
            $this->model = new $modelName(); //con esto estoy mandando a llamar al modelo
        }
    }
}