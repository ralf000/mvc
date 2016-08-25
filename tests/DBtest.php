<?php

 namespace tests;

require_once dirname(__DIR__) . '/autoload.php';

use app\DB;
use app\helpers\Helper;
use app\models\User;

 class DBtest {

     public static function executeTest() {
         $sql = "SELECT * FROM user WHERE name = ?";
         return DB::execute($sql, ['Иван']);
     }

     public static function queryTest() {
         $sql = "SELECT * FROM user WHERE name = ?";
         return DB::query($sql, User::class, ['Иван']);
     }

 }
 
 Helper::g(DBtest::executeTest());
 Helper::g(DBtest::queryTest());
 