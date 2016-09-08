<?php

 namespace app\models;

 class Users extends Model {
     
     use \app\traits\TTimestamp;
     
     const TABLE = 'users';

     public $name;
     public $email;

 }
 