<?php

 namespace app;

 abstract class SingletonAbstract {

     protected static $instance = NULL;

     abstract protected function __construct();

     public static function init() {
         if (is_null(static::$instance))
             static::$instance = new static;
         return static::$instance;
     }

 }
 