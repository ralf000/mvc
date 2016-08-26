<?php

 namespace app\models;

use app\DB;

 abstract class Model implements CRUDInterface {

     protected $db = NULL;
     private static $table = '';
     protected static $timeOn = FALSE;

     public function __construct() {
         if (is_null($this->db))
             $this->db = DB::init()->connect();
     }

     public static function findById($id) {
         $result = DB::query('SELECT * FROM ' . self::getTable() . ' WHERE id = ?', static::class, [$id]);
         return (!empty($result)) ? $result : FALSE;
     }

     public static function findAll($condition = '') {
         return DB::query('SELECT * FROM ' . self::getTable() . ' ' . $condition . ' ', static::class);
     }

     public static function insert(array $params) {
         if (static::$timeOn)
             $params['created_at'] = date('Y-m-d H:i:s');

         $preparedParams = self::getPreparedParams($params);
         return DB::execute('INSERT INTO ' . self::getTable() . ' (' . $preparedParams['fields'] . ') VALUES (' . $preparedParams['placeholders'] . ')', array_values($params));
     }

     private static function getPreparedParams(array $params) {
         $output = $fields = '';
         foreach ($params as $key => $param) {
             $output .= '?,';
             $fields .= "`$key`,";
         }

         return [
             'placeholders' => rtrim($output, ','),
             'fields'       => rtrim($fields, ',')
         ];
     }

     static function getTable() {
         self::$table = end(explode('\\', static::class));
         return self::$table;
     }

     static function setTable($table) {
         self::$table = $table;
     }

     static function timeOn($time) {
         self::$timeOn = $time;
     }

 }
 