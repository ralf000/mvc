<?php

 namespace app\models;
 
 /**
  * This is the model class for table "news".
  *
  * @property integer $id
  * @property string $title
  * @property string $decription
  * @property string $content
  * @property Author $author
  * @property DateTime $created_at
  * @property DateTime $updated_at
  */
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
 