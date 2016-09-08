<?php

 namespace app\helpers;

 class RequestRegistry {

     use \app\traits\TSingleton;

     private $values = [];

     public static function getRequest() {
         $inst = self::init();
         if (is_null($inst->get('request'))) {
             $inst->set('request', new Request());
         }
         return $inst->get("request");
     }

     protected function get($key) {
         if (isset($this->values[$key]))
             return $this->values[$key];
         return null;
     }

     protected function set($key, $val) {
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
 