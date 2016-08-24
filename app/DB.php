<?php

 namespace app;

use PDO;

 class DB {

     private static $db = NULL;
     private static $instance = NULL;

     private function __construct() {
         if (!is_null(self::$db))
             return self::$db;

         $dbParams = require_once dirname(__DIR__) . '/config/db_params.php';
         $dsn = "mysql:host={$dbParams['host']};dbname={$dbParams['name']}";
         $opts = [
             PDO::ERRMODE_WARNING => TRUE,
             PDO::ATTR_ERRMODE    => TRUE
         ];
         self::$db = new PDO($dsn, $dbParams['user'], $dbParams['pass'], $opts);
     }

     public static function init() {
         if (is_null(self::$instance))
             self::$instance = new self;
         return self::$instance;
     }

     public function connect() {
         return self::$db;
     }
     
     public static function execute($sql){
         $db = self::init()->connect();
         $stmt = $db->prepare($sql);
         $result = $stmt->execute();
         return $result;
     }
 }
 