<?php

 require __DIR__ . '/autoload.php';

 try {
  if (!filter_has_var(INPUT_GET, 'one-news')) {
         $news = app\models\News::getLatestNews(3);
         include_once __DIR__ . '/app/views/news/index.php';
     } else {
         if (filter_has_var(INPUT_GET, 'one-news') && filter_has_var(INPUT_GET, 'id'))
             $id = filter_input(INPUT_GET, 'id');
         if (!is_numeric($id))
             throw new Exception('Не верный id новости');
         $item = app\models\News::findById($id);
         include_once __DIR__ . '/app/views/news/view.php';
     }
 } catch (Exception $ex) {
     \app\helpers\Helper::g($ex);
 }
 