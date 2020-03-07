<?php

class main extends controller {

    function __construct() {
        parent::__contruct();
        $this->view->render('main/index');
        //echo 'main';
    }

}
