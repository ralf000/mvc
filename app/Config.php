<?php

 namespace app;

 class Config {

     use \app\traits\TSingleton;

     private static $data = [];

     private function __construct() {
         self::$data['config'] = require_once dirname(__DIR__) . '/config/config.php';
         self::$data['db'] = require_once dirname(__DIR__) . '/config/db_params.php';
         if (empty(self::$data['db']))
             throw new \Exception('Не удалось получить конфиг базы данных');
     }

     public static function getConfig() {
         self::init();
         if (!empty(self::$data))
             return self::$data;
         throw new \Exception('Не удалось получить конфиг');
     }

 }
 