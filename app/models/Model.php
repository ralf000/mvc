<?php

 namespace app\models;

 use app\DB;

 abstract class Model implements CRUDInterface {

     protected static $timeOn = FALSE;
     public $id;

     public static function findById($id) {
         $result = DB::query('SELECT * FROM ' . static::TABLE . ' WHERE id = ?', static::class, [$id]);
         return (!empty($result)) ? $result[0] : FALSE;
     }

     public static function findAll($condition = '') {
         return DB::query('SELECT * FROM ' . static::TABLE . ' ' . $condition . ' ', static::class);
     }

     public function insert() {
         if (!$this->isNew())
             return;

         $columns = [];
         foreach ($this as $k => $v) {
             if ($k === 'id')
                 continue;
             if ($k === 'created_at')
                 $columns[$k] = date('Y-m-d H:i:s');
             $columns[$k] = $v;
         }
         $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', array_keys($columns)) . ') VALUES (:' . implode(',:', array_keys($columns)) . ')';
         DB::execute($sql, $columns);
         $this->id = DB::getLastInsertId();
     }

     public function update() {
         if ($this->isNew())
             return;

         $columns = [];
         $queryParams = '';
         foreach ($this as $k => $v) {
             if ($k === 'created_at' || $k === 'updated_at')
                 continue;
             if ($k !== 'id')
                 $queryParams .= "$k = :$k,";
             $columns[":$k"] = $v;
         }
         $queryParams .=
                 $sql = 'UPDATE ' . static::TABLE . ' SET ' . rtrim($queryParams, ',') . ' WHERE id = :id';
         $this->id = DB::execute($sql, $columns);
     }
     
     public static function delete($id){
         return DB::query('DELETE FROM ' . static::TABLE . ' WHERE id = ?', static::class, [$id]);
     }


     /**
      * Включить время сохранения и обновления у модели
      * @param bool $time
      */
     static function timeOn($time) {
         static::$timeOn = $time;
     }

     public function isNew() {
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
 