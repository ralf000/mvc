<?php

 use app\common\controllers\FrontController;

require __DIR__ . '/autoload.php';

 try {
     $frontController = new FrontController();
     $frontController->run();
 } catch (Exception $ex) {
     echo $ex->getMessage();
 }