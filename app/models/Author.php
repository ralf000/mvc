<?php

 namespace app\models;

 class Author extends Model {
     
     const TABLE = 'authors';

     public $name;
     
     public function __toString()
     {
         return $this->name;
     }

 }
 