<?php

/** this is the entry point of the application  */


use application\core\Application;
require_once '../application/core/Application.php';

/** function to show console log  */
function console_log( $data ){
    $toDebug = json_encode($data);
    $toConsole = <<<EOD
    <script>
        console.log('$toDebug')
    </script>
EOD;
    echo $toConsole;
}

new Application();

