<?php

 namespace app\admin\controllers;

use app\common\controllers\Controller;

 class IndexController extends Controller {

     public function actionIndex() {
         $this->view->index = 'Hello World from Admin Panel!';
         $this->view->display('index/index.php');
     }

 }
 