<?php

 namespace app;

 use PDO;

 class DB {

     use traits\TSingleton;

     private static $db = NULL;
     private static $stmt;
     private static $lastInsertId = NULL;

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

     public function connect() {
         return self::$db;
     }

     public static function execute($sql, array $prepared = []) {
         $db = self::init()->connect();
         self::$stmt = $db->prepare($sql);
         $result = self::$stmt->execute($prepared);

         if ($db->lastInsertId())
             self::$lastInsertId = $db->lastInsertId();

         return $result;
     }

     public static function query($sql, $class, array $prepared = []) {
         if (!self::execute($sql, $prepared))
             return [];
         if (strpos(strtolower($sql), 'select') !== FALSE)
             return self::$stmt->fetchAll(PDO::FETCH_CLASS, $class);
         return TRUE;
     }

     static function getLastInsertId() {
         return self::$lastInsertId;
     }

 }
 