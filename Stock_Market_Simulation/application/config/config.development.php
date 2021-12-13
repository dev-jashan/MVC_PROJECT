<?php




/**
 * Returns the full configuration.
 * This is used by the core/Config class.
 */
return array(
   
   'URL' =>'http://' .$_SERVER['HTTP_HOST'] .str_replace('public','',dirname($_SERVER['SCRIPT_NAME'])),
    'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
    'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',
    'DEFAULT_CONTROLLER' => 'index',
    'DEFAULT_ACTION' => 'index',
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'stock_market',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_PORT' => '8080',
    'DB_CHARSET'=>'utf8'
);
