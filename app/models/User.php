<?php

 namespace app\models;

 class User{
     public $name;
     public $email;
     
     public static function findAll(){
         return \app\DB::query('SELECT * FROM user', __CLASS__);
     }
 }
 