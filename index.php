<?php

 use app\helpers\RequestRegistry;
 use app\models\News;

require __DIR__ . '/autoload.php';

 try {
     
     $c = new app\controllers\News();
     $action = RequestRegistry::get('action') ?: 'index';
     $c->action($action);
     
//     if (RequestRegistry::has('news/index')) {
//         $news = News::findAll('ORDER BY id DESC');
//         require_once 'app/views/news/index.php';
//     } elseif (RequestRegistry::has(['news/view', 'id'])) {
//         $id = RequestRegistry::get('id', TRUE);
//         $item = News::findById($id);
//         require_once 'app/views/news/view.php';
//     } elseif (RequestRegistry::has(['news/edit', 'id'])) {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $id = RequestRegistry::get('id', TRUE);
//             $model = News::findById($id);
//             $model->fill();
//             if ($model->save()) {
//                 header('Location: /?news/view&id=' . $id);
//                 exit;
//             }
//         }
//         $id = RequestRegistry::get('id', TRUE);
//         $item = News::findById($id);
//         require_once 'app/views/news/edit.php';
//     } elseif (RequestRegistry::has('news/create')) {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $model = new News();
//             $model->fill();
//             if ($model->save()) {
//                 header('Location: /?news/index');
//                 exit;
//             }
//         }
//         require_once 'app/views/news/create.php';
//     } elseif (RequestRegistry::has(['news/remove', 'id'])) {
//         $model = new News();
//         $id = RequestRegistry::get('id', TRUE);
//         if ($model->delete($id)) {
//             header('Location: /?news/index');
//             exit;
//         }
//     }
 } catch (Exception $ex) {
     \app\helpers\Helper::g($ex->getMessage());
 }