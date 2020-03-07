<?php

class controller{
    
    function __contruct(){
        //echo "controlador base";
        $this->view = new View();
    }
    function loadModel($model){
        $url = 'models/'.$model. '_model.php';
        
        if(file_exists($url)){
            require $url;
            
            $modelName= $model.'_model';
            $this->model = new $modelName(); //con esto estoy mandando a llamar al modelo
        }
    }
}