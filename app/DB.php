<?php

 namespace app;

use PDO;

 class DB {

     private static $db = NULL;
     private static $instance = NULL;
     private static $stmt;

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

     public static function execute($sql) {
         $db = self::init()->connect();
         self::$stmt = $db->prepare($sql);
         $result = self::$stmt->execute();
         return $result;
     }

     public static function query($sql, $class) {
         if (self::execute($sql))
             return self::$stmt->fetchAll(PDO::FETCH_CLASS, $class);
         return [];
     }
     
 }
 