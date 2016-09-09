<?php

 namespace app\common\controllers;

 use app\View;

 abstract class Controller {

     protected $view = NULL;

     public function __construct() {
         if (is_null($this->view))
             $this->view = new View();
     }

 }
 