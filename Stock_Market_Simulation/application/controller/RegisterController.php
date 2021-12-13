<?php

namespace application\controller;
use application\core\Controller;
use application\model\LoginModel;

require_once '..\application\core\Controller.php';
require_once '..\application\model\LoginModel.php';

class RegisterController extends Controller{

    public function __construct()
    {
       
        parent::__construct();
    }
    public function index()
    {
        $this->View->renderRegister('register/index');
        
    }
    public static function handelregister(){
        $user_name = self::formInputValue('name');
        $email = self::formInputValue('email');  
        $password=self::formInputValue('password');  
        $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
        $money= '10000';
        LoginModel::createUser($user_name,$hashed_pass,$email,$money);
        echo true;
    }

    static function formInputValue($value){
        $textbox = $_POST[$value];
        if(empty($textbox)){
            return false;
        }else{
            return $textbox;
        }
    }
    
}