<?php

namespace application\core;
use application\core\View;

require_once '..\application\core\View.php';

class Controller{

    public $View;

    public function __construct(){
        $this-> View= new View();
    }

}
