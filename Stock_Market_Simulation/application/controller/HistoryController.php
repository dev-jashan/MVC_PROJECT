<?php

namespace application\controller;
use application\core\Controller;
use application\model\HistoryModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\HistoryModel.php';


class HistoryController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->View->renderHistory('history/index',array('history'=> HistoryModel::getUserHistory()));
        
    }

}