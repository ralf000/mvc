<?php

 namespace app\traits;

 trait TSetGetMagic {

     private $data = [];

     public function __set($name, $value) {
         $this->data[$name] = $value;
     }

     public function __get($name) {
         if (isset($this->data[$name]))
             return $this->data[$name];
         return NULL;
     }
     
     public function __isset($name){
         return (isset($this->data[$name])) ? TRUE : FALSE;
     }
 }
 