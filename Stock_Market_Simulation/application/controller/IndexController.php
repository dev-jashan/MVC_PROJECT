<?php

namespace application\controller;
use application\core\Controller;
use application\model\StockModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\StockModel.php';

class IndexController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->View->render('index/index',array('stocks'=> StockModel::showStocks()));
        
    }

    
    
}