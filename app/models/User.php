<?php

 namespace app\models;
 
  /**
  * This is the model class for table "users".
  *
  * @property integer $id
  * @property string $name
  * @property string $email
  * @property integer $created_at
  * @property integer $updated_at
  */
 
 class User extends Model {
     
     use \app\traits\TTimestamp;
     
     const TABLE = 'users';

     public $name;
     public $email;

 }
 