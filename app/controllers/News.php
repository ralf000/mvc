<?php

 namespace app\controllers;

 use app\helpers\RequestRegistry;

 class News extends Controller {

     protected function actionIndex() {
         $this->view->news = \app\models\News::findAll('ORDER BY id DESC');
         $this->view->title = 'Все новости';
         $this->view->display('/news/index.php');
     }

     protected function actionView() {
         $id = RequestRegistry::get('id');
         if (empty($id))
             throw new \Exception('Неверный id');
         $article = \app\models\News::findById($id);
         if (empty($article))
             throw new \Exception('Данной новости не существует');
         $this->view->title = $article->title;
         $this->view->article = $article;
         $this->view->display('/news/view.php');
     }

 }
 