<?php

 namespace app\models;

 class News extends Model {
     
     public $title; 
     public $description;
     public $content;
     
     public static function getLatestNews($num){
         return self::findAll('ORDER BY id ASC LIMIT ' . $num);
     }
 }
 