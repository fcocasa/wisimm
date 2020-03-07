<?php

class model{
    
    function __contruct(){
        require_once 'libs/database.php';
        $this->db = new database();
    }
}
