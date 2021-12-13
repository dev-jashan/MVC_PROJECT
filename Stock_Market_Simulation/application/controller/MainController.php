<?php

namespace application\controller;
use application\core\Controller;
use application\model\StockModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\StockModel.php';

class MainController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    public function index()
    {
        
        $money=0;
        $user_money=StockModel::getUserMoney();
        
        //show user the money left in the user account
        foreach($user_money as $v=>$valid_money){
           $money=floatval($valid_money["money"]);
           $_SESSION['userMoney']=$money;
        }

        $this->View->renderMain('main/index',array('stocks'=> StockModel::showStocks()));
       
    }
    

}