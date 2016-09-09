<?php

 namespace app\controllers;

use app\common\controllers\Controller;

 class IndexController extends Controller {

     public function actionIndex() {
         $this->view->index = 'Hello World!';
         $this->view->display('index/index.php');
     }

 }
 