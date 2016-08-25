<?php

 namespace app\models;

use app\DB;

 class Model {

     protected $db = NULL;
     protected static $table = '';

     public function __construct() {
         if (is_null($this->db))
             $this->db = DB::init()->connect();
     }

     public static function findAll() {
         return DB::query('SELECT * FROM ' . static::getTable(), static::class);
     }

     static function getTable() {
         if (empty(static::$table))
             static::$table = end(explode('\\', static::class));
         return static::$table;
     }

     static function setTable($table) {
         self::$table = $table;
     }

 }
 