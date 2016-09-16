<?php

 namespace app\common\controllers;

use app\components\logger\Logger;
use app\Config;
use app\exceptions\DBException;
use app\exceptions\ModelNotFoundException;
use app\helpers\RequestRegistry;
use app\View;
use Exception;
use ReflectionClass;

 class FrontController {

     private $namespace = '';
     private $controller = [];
     private $action = '';
     private $params = [];
     protected $view = NULL;

     public function __construct() {
         if (is_null($this->view))
             $this->view = new View();
         $this->parseURL(RequestRegistry::server('REQUEST_URI'));
     }

     public function run() {
         $this->beforeAction();
         $controller = implode('\\', $this->getController());
         $action = $this->getAction();
         if (!class_exists($this->getNamespace() . '\\' . $controller))
             throw new Exception('Controller ' . (string) $controller . ' not found');
         $rc = new ReflectionClass($this->getNamespace() . '\\' . $controller);
         if (!$rc->hasMethod($action))
             throw new Exception('Action ' . (string) $action . ' not found');
         $controllerInstance = $rc->newInstance();
         $method = $rc->getMethod($action);
         try {
             $method->invoke($controllerInstance);
         } catch (ModelNotFoundException $ex) {
             $view = new View();
             $view->exception = $ex;
             $logger = new \Psr\Log\Logger();
             $logger->warning($ex->getMessage(), [$ex->getFile(), $ex->getLine()]);
             $view->display('errors/404');
             exit;
         } catch (DBException $ex) {
             $view = new View();
             $view->exception = $ex;
             $logger = new \Psr\Log\Logger();
             $logger->critical($ex->getMessage(), [$ex->getFile(), $ex->getLine()]);
             $view->display('errors/db-error');
             exit;
         }
     }

     protected function beforeAction() {
         
     }

     protected function parseURL($url) {
         if ($this->isAdminPanel())
             $this->setNamespace(Config::getConfig()['config']['adminControllerNamespace']);
         else
             $this->setNamespace(Config::getConfig()['config']['controllerNamespace']);

         list($link, $params) = explode('?', trim($url, '/'));
         $this->parseLink($link);
         $this->parseParams($params);
     }

     private function parseLink($link) {
         $link = explode('/', $link);
         if (count($link) <= 2) {
             if (empty($link[0]))
                 $link[0] = 'index';
             if (count($link) < 2 || empty($link[1]))
                 $link[1] = 'index';
             $this->setController($link[0]);
             $this->setAction($link[1]);
         }else {
             //здесь парсим несколько контроллеров
             $this->setAction(array_pop($link));
             $this->setController($link);
         }
     }

     private function parseParams($params) {
         $output = [];
         if (empty($params))
             return NULL;
         foreach (explode('&', $params) as $param) {
             if (strpos($param, '=') !== FALSE) {
                 list($key, $value) = explode('=', $param);
                 $output[$key] = $value;
             }
         }
         $this->setParams($output);
     }

     public static function isAdminPanel() {
         $host = RequestRegistry::server('HTTP_HOST');
         return (array_shift(explode('.', $host)) === 'admin') ? TRUE : FALSE;
     }

     function getController() {
         return $this->controller;
     }

     function getAction() {
         return $this->action;
     }

     function setController($controller) {
         if (is_array($controller)) {
             $this->controller = array_map(function($e) {
                 return ucfirst($e) . 'Controller';
             }, $controller);
             return;
         }
         $this->controller[] = ucfirst($controller) . 'Controller';
     }

     function setAction($action) {
         $this->action = 'action' . ucfirst($action);
     }

     function setParams($params) {
         $this->params = $params;
     }

     function getParams() {
         return $this->params;
     }

     function getNamespace() {
         return $this->namespace;
     }

     function setNamespace($namespace) {
         $this->namespace = $namespace;
     }

 }
 