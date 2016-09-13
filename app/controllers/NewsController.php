<?php

 namespace app\controllers;

use app\common\controllers\Controller;
use app\exceptions\ModelNotFoundException;
use app\helpers\RequestRegistry;
use app\models\News;
use Exception;

 class NewsController extends Controller {

     public function actionIndex() {
         $this->view->news = News::findAll('ORDER BY id DESC');
         $this->view->display('news/index.php');
     }

     public function actionView() {
         $id = RequestRegistry::get('id');
         if (empty($id))
             throw new Exception('Неверный id');
         $article = News::findById($id);
         if (empty($article))
             throw new ModelNotFoundException('Данной новости не существует');
         $this->view->article = $article;
         $this->view->display('news/view.php');
     }

 }
 