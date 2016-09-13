<?php

use app\common\controllers\FrontController;
use app\exceptions\DBException;
use app\helpers\Helper;

require __DIR__ . '/autoload.php';

 try {
     $frontController = new FrontController();
     $frontController->run();
 } catch (DBException $ex) {
     echo $ex->getException();
 }