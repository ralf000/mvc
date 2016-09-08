<?php

 namespace app\controllers;

use app\View;
 
 class News {
     
     public function actionIndex() {
         $view = new View();
         $view->title = 'Все новости';
         $view->news = News::findAll('ORDER BY id DESC');
         $view->display($view->viewPath . '/news/index.php');
     }
 }
 