<?php

namespace application\controller;
use application\core\Controller; 
use application\model\StockModel;


require_once '..\application\core\Controller.php';
require_once '..\application\model\StockModel.php';


class TransController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->View->renderCart('trans/index',array('stocks'=> StockModel::userCart($_SESSION['userId'])));
        
    }

    // get all the stocks available to be bought
    public static function getBuyData(){
        
        $data = $_POST['data'];
        $stock_data=json_decode($data,true);
        $symbol=$stock_data[0];
        $open=$stock_data[1];
        $buy=$stock_data[5];
        StockModel::storeBuy($symbol,$open,$_SESSION['userId'],1,$buy);
         //echo $buy;
        
    }

    //remove data from the cart
    public static function removeStock(){
        
        $data = $_POST['data'];
        
        StockModel::DeleteStock($data,$_SESSION['userId']);
        echo true;
      
    }

    // checkout cart 
    public static function checkoutData(){
        
        $data = $_POST['data'];
        $checkout_data=json_decode($data,true);
        $money=0;
        $buy=0;
        $sell=0;

        //get current money of the user
        $user_money=StockModel::getUserMoney();
        foreach($user_money as $v=>$valid_money){
            $money=floatval($valid_money["money"]);
        }
      

        //$d=$checkout_data[0];
        foreach($checkout_data as $stock_info){
            $symbol=$stock_info[0];
            $qty=$stock_info[1];
            $price=$stock_info[2];
            $status=$stock_info[3];
            $date=$stock_info[4];
            
            
            StockModel::userCheckout($symbol,$price,$date,$qty,$status,$date);
            if($status=='buy'){
                StockModel::storeCheckoutData($symbol,$price,$_SESSION['userId'],$qty,$status);
                $buy+=floatval($price);
                
            }elseif($status=='sell'){
               
                $sell+=floatval($price);
                StockModel::DeleteSellStock($symbol);
               
            }
            StockModel::DeleteStock($symbol);
            $valid_money=$money+$sell-$buy;
            StockModel::updateBuyMoney($valid_money,$_SESSION['userId']);

                
            
        
        }
      
        
        echo true;
        

    }
    
   
 
    // to store all the data /stocks to be sold
    public static function getSellData(){
        
        $data = $_POST['data'];
        $stock_data=json_decode($data,true);
        $symbol=$stock_data[0];
        $open=$stock_data[1];
        $qty=$stock_data[2];
        StockModel::storeSell($symbol,$open,$_SESSION['userId'],$qty);
        echo true;
        
    }
}