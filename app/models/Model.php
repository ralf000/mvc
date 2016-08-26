<?php

 namespace app\models;

use app\DB;

 abstract class Model implements CRUDInterface {
     
     protected static $timeOn = FALSE;
     protected $id;
     
     public static function findById($id) {
         $result = DB::query('SELECT * FROM ' . static::TABLE . ' WHERE id = ?', static::class, [$id]);
         return (!empty($result)) ? $result : FALSE;
     }

     public static function findAll($condition = '') {
         return DB::query('SELECT * FROM ' . static::TABLE . ' ' . $condition . ' ', static::class);
     }
     
     public function insert(){
         if (!$this->isNew())
             return;
         
         $columns = [];
         foreach ($this as $k => $v){
             if ($k === 'id')
                 continue;
             if ($k === 'created_at')
                 $columns[$k] = date('Y-m-d H:i:s');
             $columns[$k] = $v;
         }
         $sql = 'INSERT INTO ' . static::TABLE . ' ('.  implode(', ', array_keys($columns)) .') VALUES (:'.  implode(',:', array_keys($columns)).')';
         DB::execute($sql, $columns);
     }

//     public static function insert(array $params) {
//         if (static::$timeOn)
//             $params['created_at'] = date('Y-m-d H:i:s');
//
//         $preparedParams = static::getPreparedParams($params);
//         return DB::execute('INSERT INTO ' . static::getTable() . ' (' . $preparedParams['fields'] . ') VALUES (' . $preparedParams['placeholders'] . ')', array_values($params));
//     }

//     private static function getPreparedParams(array $params) {
//         $output = $fields = '';
//         foreach ($params as $key => $param) {
//             $output .= '?,';
//             $fields .= "`$key`,";
//         }
//
//         return [
//             'placeholders' => rtrim($output, ','),
//             'fields'       => rtrim($fields, ',')
//         ];
//     }

     static function timeOn($time) {
         static::$timeOn = $time;
     }
     
     public function isNew(){
         return empty($this->id);
     }


//     static function getTable() {
//         static::$table = end(explode('\\', static::class));
//         return static::$table;
//     }

     static function setTable($table) {
         static::$table = $table;
     }


 }
 