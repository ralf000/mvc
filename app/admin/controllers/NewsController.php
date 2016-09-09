<?php

 namespace app\admin\controllers;

 use app\common\controllers\Controller;
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
             throw new Exception('Данной новости не существует');
         $this->view->article = $article;
         $this->view->display('news/view.php');
     }

     public function actionCreate() {
         if (RequestRegistry::isPost()) {
             $model = new News();
             $model->fill();
             if ($model->save()) {
                 header('Location: /news');
                 exit;
             }
         }
         $this->view->display('news/create.php');
     }

     public function actionEdit() {
         $id = RequestRegistry::get('id');
         if (RequestRegistry::isPost()) {
             $model = News::findById($id);
             $model->fill();
             if ($model->save()) {
                 header('Location: /news/view?id=' . $id);
                 exit;
             }
         }
         $this->view->article = News::findById($id);
         if (!isset($this->view->article))
             throw new Exception('Данной новости не существует');
         $this->view->display('news/edit.php');
     }

     public function actionRemove() {
         $model = new News();
         $id = RequestRegistry::get('id');
         if ($model->delete($id)) {
             header('Location: /news');
             exit;
         }
     }

 }
 