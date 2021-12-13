<?php
namespace application\model;

use  application\core\DatabaseFactory;
require_once '..\application\core\DataBaseFactory.php';

class HistoryModel{
  
   public static function getUserHistory()
   {
    return DatabaseFactory::getFactory()->query('SELECT * from stocktbl WHERE UserID=?',$_SESSION['userId'])->fetchAll();
   }
   

}