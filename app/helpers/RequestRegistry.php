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

 }
 