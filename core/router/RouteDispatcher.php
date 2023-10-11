<?php

namespace Core\router;

use App\Models\users\UserModel;
use Core\Core;
use Exception;
use Throwable;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array $paramRequestMap = [];
    public array $paramMap = [];
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function prepareRoute() {
        //приходит запрос, и мы сразу удаляем слэши
        //разбиваем строку запроса на массив
        //разбиваем строку запросана массив и проверяем  если такой параметр
        //если есть такая позиция, значит приводим строку запроса в регулярное выражение
        //запускаем контроллер и экшн


        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();


    }

    //очищаем запрос от слэшей
    private function saveRequestUri() {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri =$this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->setRoute($this->clean($this->routeConfiguration->getRoute()));
        }
    }

    //замена слэшей
    private function clean($str) {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    //разбиваем роут на массив и параметры
    private function setParamMap() {

        $routeArray = explode('/', $this->routeConfiguration->getRoute());

        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}*)/', '', $param);
            }
        }

    }

    //приводим строку запроса в регулярное выражение
    private function makeRegexRequest() {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                break;
            }

            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();


    }

    private function prepareRegex() {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    //проверяем если наша строка запроса в роутинге, если есть вызываем метод на запуск контроллера
    public function run() {

            if(preg_match("/$this->requestUri/", $this->routeConfiguration->getRoute())) {
                return $this->render();
            }
    }

    private function render() {

        $ClassName = $this->routeConfiguration->getController();
        $action = $this->routeConfiguration->getAction();
        $container = Core::getInstance()->getSystemObject('di');


        $object = $container->get($ClassName);
        $object->$action(...$this->paramRequestMap);
        die;

    }
}