<?php
namespace application\core;

require_once 'Config.php';


class Application{
    
    /** @var Controller Instance of the controller */
    private Controller $controller;

    /** @var array URL parameters, will be passed to used controller-method */
    private array $parameters = array();

    /** @var string Just the name of the controller, useful for checks inside the view ("where am I ?") */
    private ?string $controller_name = null;

    /** @var string Just the name of the controller's method, useful for checks inside the view ("where am I ?") */
    private ?string $action_name = null;



    public function __construct(){
       
        $this->splitUrl();
        $this->createControllerAndActionNames();
        session_start();
        //session_destroy();
        if(!($this->controller_name == 'LoginController' || $this->controller_name == 'RegisterController'|| $this->controller_name == 'IndexController') && !isset($_SESSION['userId'])){

            header('Location: http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/index/index');
            
        
        }elseif (file_exists(Config::get('PATH_CONTROLLER') . $this->controller_name . '.php')) {
                // load this file and create this controller
                // example: if controller would be "car", then this line would translate into: $this->car = new car();
                require_once Config::get('PATH_CONTROLLER') . $this->controller_name . '.php';

                $class='\application\controller\\'.$this->controller_name;
                //console_log($class);
                $this->controller = new $class();
               
                // check are controller and method existing and callable?
                if (is_callable(array($this->controller, $this->action_name))) {
                
                    if (!empty($this->parameters)) {
                        // call the method and pass arguments to it
                        call_user_func_array(array($this->controller, $this->action_name), $this->parameters);
                    } else {
                        // if no parameters are given, just call the method without parameters, like $this->index->index();
                        $this->controller->{$this->action_name}();
                    }
                } else {
                    // load 404 error page
                    // require Config::get('PATH_CONTROLLER') . 'ErrorController.php';
                    // $this->controller = new ErrorController;
                    // $this->controller->error404();
                }
            } else {
            
                // require Config::get('PATH_CONTROLLER') . 'ErrorController.php';
                // $this->controller = new ErrorController;
                // $this->controller->error404();
            }
          
    }

    private function splitUrl()
    {
        
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
           
            $url = filter_var($url, FILTER_SANITIZE_URL);
           
            $url = explode('/', $url);
           

            // put URL parts into according properties
            $this->controller_name = isset($url[0]) ? $url[0] : null;
            //console_log($this->controller_name);
            $this->action_name = isset($url[1]) ? $url[1] : null;
           // console_log($this->action_name);

            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);

            // rebase array keys and store the URL parameters
            $this->parameters = array_values($url);
        }
    }

    private function createControllerAndActionNames()
    {
        // check for controller: no controller given ? then make controller = default controller (from config)
        if (!$this->controller_name) {
            $this->controller_name = Config::get('DEFAULT_CONTROLLER');
            
        }

        // check for action: no action given ? then make action = default action (from config)
        if (!$this->action_name OR (strlen($this->action_name) == 0)) {
            $this->action_name = Config::get('DEFAULT_ACTION');
            
        }

        // rename controller name to real controller class/file name ("index" to "IndexController")
        $this->controller_name = ucwords($this->controller_name) . 'Controller';
    }

}
