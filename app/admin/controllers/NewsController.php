<?php

 namespace app\admin\controllers;

 use app\admin\components\AdminDataTable;
 use app\common\controllers\Controller;
 use app\exceptions\ModelNotFoundException;
 use app\exceptions\MultiException;
 use app\helpers\Helper;
 use app\helpers\RequestRegistry;
 use app\models\News;
 use Exception;

 class NewsController
        extends Controller
 {

     public function actionIndex()
     {
//         $this->view->news = News::findAllWithGenerator('ORDER BY id DESC');
         $this->view->news = News::findAll('ORDER BY id DESC');
         $this->view->display('news/index.php');
     }

     public function actionTest()
     {
         $models = News::findAllWithGenerator('ORDER BY id DESC');
         $thead = ['id', 'title', 'description', 'content', 'author', 'created_at', 'updated_at'];
         foreach ($thead as $cell) {
             $functions[] = function(\app\models\Model $object) use ($cell) {
                 return [$cell => $object->$cell];
             };
         }
         $adminDataTable = new AdminDataTable($models, $functions, $thead);
         $this->view->news = $adminDataTable->render();
         $this->view->display('news/test.php');
     }

     public function actionView()
     {
         $id = RequestRegistry::get('id');
         if (empty($id))
             throw new Exception('Неверный id');
         $article = News::findById($id);
         if (!$article)
             throw new ModelNotFoundException('Данной новости не существует');
         $this->view->article = $article;
         $this->view->display('news/view.php');
     }

     public function actionCreate()
     {
         if (RequestRegistry::isPost()) {
             $model = new News();
             try {
                 $model->fill(RequestRegistry::post(), ['title', 'content']);
                 if ($model->save()) {
                     header('Location: /news');
                     exit;
                 }
             } catch (MultiException $ex) {
                 $this->view->exceptions = $ex;
             }
         }
         $this->view->display('news/create.php');
     }

     public function actionEdit()
     {
         $id = RequestRegistry::get('id');
         if (RequestRegistry::isPost()) {
             $model = News::findById($id);
             $model->fill(RequestRegistry::post());
             if ($model->save())
                 Helper::redirect('/news/view?id=' . $id);
         }
         $this->view->article = News::findById($id);
         if (!$this->view->article)
             throw new ModelNotFoundException('Данной новости не существует');
         $this->view->display('news/edit.php');
     }

     public function actionRemove()
     {
         $model = new News();
         $id = RequestRegistry::get('id');
         if ($model->delete($id))
             Helper::redirect('/news');
     }

 }
 