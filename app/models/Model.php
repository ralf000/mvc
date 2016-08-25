<?php

 namespace app\models;

use app\DB;

 class Model{

     protected $db = NULL;

     public function __construct() {
         if (is_null($this->db))
             $this->db = DB::init()->connect();
     }
     
 }
 