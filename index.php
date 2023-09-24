<?php

use Core\Core;
use Core\Router\Router;

//E_Warning теперь можно отловить...
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // Этот код ошибки не входит в error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

set_error_handler('exception_error_handler');

//подключаем автозагрузку namespace
require_once 'vendor/autoload.php';
require_once 'web/web.php';


$core = Core::getInstance();
//создаем наши системные объекты...
$core->init();

$Router = $core->getSystemObject('router');
$Router->run();

?>