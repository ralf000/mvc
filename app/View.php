<?php

 namespace app;

 class View {

     private $data = [];

     public function __set($name, $value) {
         $this->data[$name] = $value;
     }

     public function __get($name) {
         if (isset($this->data[$name]))
             return $this->data[$name];
         return NULL;
     }

 }
 