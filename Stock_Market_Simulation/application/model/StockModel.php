<?php
namespace application\model;

use  application\core\DatabaseFactory;
require_once '..\application\core\DataBaseFactory.php';

class StockModel{

   // to retrive all the stocks 
   public static function showStocks():array
   {
      return DatabaseFactory::getFactory()->query('SELECT * from stockinfo ORDER BY high DESC;')->fetchAll();
   }

   // to store the buy/sell data  in cart (not yet chekedout)
   public static function storeBuy($sym,$open,$user,$qty,$buy)
   {
      return DatabaseFactory::getFactory()->query("INSERT INTO stockcart (stock_name,stock_open,UserID,stock_qty,stock_status) VALUES (?,?,?,?,?)",$sym,$open,$user,$qty,$buy);
   }

   // get all the data present in cart to be show in the cart view
   public static function userCart($user_id)
   {
      return DatabaseFactory::getFactory()->query('SELECT * from stockcart WHERE UserID=?',$user_id)->fetchAll();
   }

   // when user removes a stock form cart then delete the stock from the cart
   public static function DeleteStock($stockName){
      DatabaseFactory::getFactory()->query("DELETE FROM stockcart WHERE stock_name=? AND UserID=?",$stockName,$_SESSION['userId']);
   }
   //if shocks are sold then delete the data from the sell database
   public static function DeleteSellStock($stockName){
      DatabaseFactory::getFactory()->query("DELETE FROM checkout_data WHERE stock_name=? AND UserID=?",$stockName,$_SESSION['userId']);
   }

   public static function getSellStock($user_id){
      DatabaseFactory::getFactory()->query('SELECT * from stockcart WHERE UserID=?',$user_id)->fetchAll();
   }
   
   // data to be stored after user checkout
   public static function userCheckout($sym,$price,$date,$qty,$status)
   {
      return DatabaseFactory::getFactory()->query("INSERT INTO stocktbl (stock_name,status,price,d_o_p,qty,UserID) VALUES (?,?,?,?,?,?)",$sym,$status,$price,$date,$qty,$_SESSION['userId']);
   }

   // show all the stocks user bought to be show in the sell view 
   public static function showBoughtStocks($user_id):array
   {
      return DatabaseFactory::getFactory()->query('SELECT * from checkout_data WHERE UserID=?;',$user_id)->fetchAll();
   }

   //store all the selling  stocks
   public static function storeSell($sym,$open,$user,$qty)
   {
      return DatabaseFactory::getFactory()->query("INSERT INTO stockcart (stock_name,stock_open,UserID,stock_qty,stock_status) VALUES (?,?,?,?,?)",$sym,$open,$user,$qty,'sell');
   }

   //store all the stocks that are available to be sold
   public static function storeCheckoutData($sym,$open,$user,$qty,$buy)
   {
      return DatabaseFactory::getFactory()->query("INSERT INTO checkout_data (stock_name,stock_price,qty,status,UserID) VALUES (?,?,?,?,?)",$sym,$open,$qty,$buy,$user);
   }

   //update the user money every time a transection is done
   public static function updateBuyMoney($money,$user_id){
      DatabaseFactory::getFactory()->query("UPDATE usertbl SET money=? WHERE id=?",$money,$user_id);
   }
   
   // to get current money that is hold by the user
   public static function getUserMoney():array
   {
      return DatabaseFactory::getFactory()->query('SELECT * from usertbl WHERE ID=?;',$_SESSION['userId'])->fetchAll();
   }
}