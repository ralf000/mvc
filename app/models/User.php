<?php

 namespace app\models;

 class User extends Model {
     
     use \app\traits\TTimestamp;
     
     const TABLE = 'user';

     public $name;
     public $email;

 }
 