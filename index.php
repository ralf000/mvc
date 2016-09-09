<?php

use app\common\controllers\FrontController;
use app\helpers\Helper;

require __DIR__ . '/autoload.php';

 try {
     $frontController = new FrontController();
     $frontController->run();
 } catch (Exception $ex) {
     Helper::g($ex->getMessage());
 }