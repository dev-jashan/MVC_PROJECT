<?php

namespace application\controller;
use application\core\Controller;
use application\model\StockModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\StockModel.php';

class SellController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    public function index()
    {
        //$this->View->renderMain('main/index',array('stocks'=> StockModel::showStocks()));
       $this->View->renderSell('sell/index',array('sold'=> StockModel::showBoughtStocks($_SESSION['userId'])));
        
    }
    

}