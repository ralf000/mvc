<?php

 namespace app\models;

 interface CRUDInterface {

     public static function findById($id);

     public static function findAll();
 }
 