<?php

 namespace app;

 use app\exceptions\DBException;
 use PDO;
 use PDOException;

 class DB {

     use traits\TSingleton;

     private static $db = NULL;
     private static $stmt;
     private static $lastInsertId = NULL;

     private function __construct() {
         if (!is_null(self::$db))
             return self::$db;

         $dbParams = Config::getConfig()['db'];
         $dsn = "mysql:host={$dbParams['host']};dbname={$dbParams['name']}";
         try {
             self::$db = new PDO($dsn, $dbParams['user'], $dbParams['pass']);
             $this->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $ex) {
             $dbEx = new DBException('Не могу подключиться к бд');
             $dbEx->PDO = $ex;
             throw $dbEx;
         }
     }

     public function connect() {
         return self::$db;
     }

     public static function execute($sql, array $prepared = []) {
         $db = self::init()->connect();
         try {
             self::$stmt = $db->prepare($sql);
             $result = self::$stmt->execute($prepared);
         } catch (PDOException $ex) {
             $dbEx = new DBException('Ошибка запроса к бд');
             $dbEx->PDO = $ex;
             throw $dbEx;
         }

         if ($db->lastInsertId())
             self::$lastInsertId = $db->lastInsertId();

         return $result;
     }

     public static function query($sql, $class, array $prepared = []) {
         if (self::execute($sql, $prepared))
             return self::$stmt->fetchAll(PDO::FETCH_CLASS, $class);
         return TRUE;
     }

     static function getLastInsertId() {
         return self::$lastInsertId;
     }

 }
 