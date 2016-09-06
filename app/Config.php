<?php

 namespace app;

 class Config {

     use \app\traits\TSingleton;

     public $data = [];
     
     private function __construct() {
         $this->data = require_once dirname(__DIR__) . '/config/db_params.php';
          if (empty($this->data))
             throw new \Exception('Не удалось получить конфиг базы данных');
     }
     
 }
 