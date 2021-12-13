<?php

namespace application\controller;
use application\core\Controller;
use application\model\LoginModel;
use application\model\StockModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\LoginModel.php';
require_once '..\application\model\StockModel.php';


class LoginController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    public function index()
    {
        $this->View->renderLogin('login/index');
        
    }
    public static function handelLogin(){
        $user_name = self::formInputValue('name');
        $password = self::formInputValue('password'); 
        if(!empty($user_name)&&!empty($password)){
            $user= LoginModel::getUser($user_name);
            
            //console_log($user);
            $url='';
            $status='';
            $err='';
            $id="";
        // echo 'we are inside if loop';
            foreach($user as $key => $value){
            
                $valid_user=$value["name"];
                $valid_pass=$value["password"];
                $valid_id=$value["ID"];
                $valid_money=$value["money"];
                
                if($valid_user==$user_name){
                   
                    if(password_verify($password,$valid_pass)){
                        //echo 'pass verified';
                        $status="true";
                        $url="http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/main/index";
                        $err="WELCOME USER";
                        $_SESSION['userId']=$valid_id;
                        $_SESSION['money']=$valid_money;
                        $_SESSION['name']=$valid_user;
                    //$valid_money;
                        //setcookie($valid_money);
                    
                        
                    }else{  
                        $url="http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/login/index";
                        $status="false";
                    // echo ' not found';
                    }
                }else{
                    $url="http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/login/index";
                    $status="false";
                }
                
            } 
            echo json_encode($reigster=array("status"=>$status, "url"=>$url,"err"=>$err,"id"=>$_SESSION['userId'])) ;
        }
} 
    static function formInputValue($value){
        $textbox = $_POST[$value];
        if(empty($textbox)){
            return false;
        }else{
            return $textbox;
        }
    }

    public static function logout(){
        session_destroy();
        header('Location: http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/login/index');
    }


}