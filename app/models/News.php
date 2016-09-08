<?php

 namespace app\models;

 class News extends Model {
     
     use \app\traits\TTimestamp;
     
     const TABLE = 'news';

     public $author_id;
     public $title;
     public $description;
     public $content;

     /**
      * Возращает несколько последних новостей
      * @param int $num количество новостей
      * @return array Объекты новостей
      */
     public static function getLatestNews($num){
         return self::findAll('ORDER BY id ASC LIMIT ' . $num);
     }
     
     public function __get($name) {
         if ($name === 'author'){
             if (!empty($this->author_id))
                 return Authors::findById($this->author_id);
         }
     }
 }
 