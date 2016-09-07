<?php

 namespace app\models;

 use app\DB;
 use app\helpers\RequestRegistry;

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

     public function save() {
         return ($this->isNew()) ? $this->insert() : $this->update();
     }

     private function insert() {
         $columns = [];
         foreach ($this as $k => $v) {
             if ($k === 'id')
                 continue;
             if ($k === 'created_at')
                 $columns[$k] = date('Y-m-d H:i:s');
             $columns[$k] = $v;
         }
         $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', array_keys($columns)) . ') VALUES (:' . implode(',:', array_keys($columns)) . ')';
         if (DB::execute($sql, $columns)) {
             $this->id = DB::getLastInsertId();
             return TRUE;
         }
     }

     private function update() {
         $columns = [];
         $queryParams = '';
         foreach ($this as $k => $v) {
             if ($k === 'created_at' || $k === 'updated_at')
                 continue;
             if ($k !== 'id')
                 $queryParams .= "$k = :$k,";
             $columns[":$k"] = $v;
         }
         $sql = 'UPDATE ' . static::TABLE . ' SET ' . rtrim($queryParams, ',') . ' WHERE id = :id';
         if (DB::execute($sql, $columns)) {
             return TRUE;
         }
     }

     /**
      * Удаляет запись из бд
      * @param int $id id записи
      * @return bool true при успешном выполнении
      */
     public static function delete($id) {
         return DB::execute('DELETE FROM ' . static::TABLE . ' WHERE id = ?', [$id]);
     }

     public function fill() {
         foreach (RequestRegistry::getRequest()->post() as $k => $v) {
             if (property_exists(get_class($this), $k))
                 $this->$k = $v;
         }
     }

     private function isNew() {
         return empty($this->id);
     }

 }
 