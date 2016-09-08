<?php

 namespace app\controllers;

use app\View;

 class Controller {

     protected $view = NULL;

     public function __construct() {
         if (is_null($this->view))
             $this->view = new View();
     }
     
     public function action($action) {
         $method = 'action' . ucfirst($action);
         $this->beforeAction();
         return $this->$method();
     }
     
     protected function beforeAction(){
         
     }
 }
 