<?php

 namespace app\helpers;

 class RequestRegistry {

     use \app\traits\TSingleton;

     private $values = [];

     public static function getRequest() {
         $inst = self::init();
         if (is_null($inst->getVar('request'))) {
             $inst->setVar('request', new Request());
         }
         return $inst->getVar("request");
     }

     public static function get($key = '', $clean = TRUE) {
         if (empty($key))
             return self::getRequest()->get($clean);
         return self::getRequest()->get($clean)[$key];
     }
     
     public static function post($key = '', $clean = TRUE) {
         if (empty($key))
             return self::getRequest()->post($clean);
         return self::getRequest()->post($clean)[$key];
     }
     
     public static function server($key = '') {
         if (empty($key))
             return self::getRequest()->server();
         return self::getRequest()->server()[$key];
     }
     
     public static function isGet(){
         return Request::isGet();
     }
     
     public static function isPost(){
         return Request::isPost();
     }

     protected function getVar($key) {
         if (isset($this->values[$key]))
             return $this->values[$key];
         return null;
     }

     protected function setVar($key, $val) {
         $this->values[$key] = $val;
     }

     public static function has($name, $type = INPUT_GET) {
         $request = new Request();
         if (is_array($name)) {
             foreach ($name as $v) {
                 if (!$request->hasVar($v, $type))
                     return FALSE;
             }
             return TRUE;
         }
         return (new Request())->hasVar($name, $type);
     }

 }
 