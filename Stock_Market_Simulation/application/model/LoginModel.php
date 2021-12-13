<?php
namespace application\model;

use  application\core\DatabaseFactory;
require_once '..\application\core\DataBaseFactory.php';

class LoginModel{
  
   public static function createUser($new_user,$new_pass,$user_email,$user_money)
   {
      return DatabaseFactory::getFactory()->query("INSERT INTO usertbl (name,password,email,money) VALUES (?,?,?,?)",$new_user,$new_pass,$user_email,$user_money);
   }
   public static function getUser($userName)
   {
      return DatabaseFactory::getFactory()->query('SELECT * from usertbl WHERE name=?',$userName)->fetchAll();
   }

}