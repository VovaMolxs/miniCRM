<?php

use Core\Core;
use Core\Router\Router;

//подключаем автозагрузку namespace
require_once 'vendor/autoload.php';


$core = Core::getInstance();
//создаем наши системные объекты...
$core->init();

//мне нужны методы объекты router, достаю их с помощью core
$router = $core->getSystemObject('router');
$router->findPatch();

?>