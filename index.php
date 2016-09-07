<?php

 require __DIR__ . '/autoload.php';

 try {
     
     $model = new \app\models\News;
     $model->title = 111;
     \app\helpers\Helper::g($model);
     
     if (filter_has_var(INPUT_GET, 'news/index')) {
         $news = app\models\News::findAll('ORDER BY id DESC');
         require_once 'app/views/news/index.php';
     } elseif (filter_has_var(INPUT_GET, 'news/view') && filter_has_var(INPUT_GET, 'id')) {
         $id = filter_input(INPUT_GET, 'id');
         $item = app\models\News::findById($id);
         require_once 'app/views/news/view.php';
     } elseif (filter_has_var(INPUT_GET, 'news/edit') && filter_has_var(INPUT_GET, 'id')) {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $id = filter_input(INPUT_GET, 'id');
             $model = app\models\News::findById($id);
             $model->fill();
             if ($model->save()) {
                 header('Location: /?news/view&id=' . $id);
                 exit;
             }
         }
         $id = filter_input(INPUT_GET, 'id');
         $item = app\models\News::findById($id);
         require_once 'app/views/news/edit.php';
     } elseif (filter_has_var(INPUT_GET, 'news/create')) {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $model = new \app\models\News();
             $model->fill();
             if ($model->save()) {
                 header('Location: /?news/index');
                 exit;
             }
         }
         require_once 'app/views/news/create.php';
     } elseif (filter_has_var(INPUT_GET, 'news/remove') && filter_has_var(INPUT_GET, 'id')) {
         $model = new \app\models\News();
         $id = filter_input(INPUT_GET, 'id');
         if ($model->delete($id)) {
             header('Location: /?news/index');
             exit;
         }
     }
 } catch (Exception $ex) {
     $ex->getMessage();
 }