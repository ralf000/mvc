<?php

 namespace app\traits;

 trait TSingleton {

     protected static $instance = NULL;

     private function __construct(){}

     public static function init() {
         if (is_null(static::$instance))
             static::$instance = new static;
         return static::$instance;
     }

 }
 