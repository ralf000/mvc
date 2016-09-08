<?php

 namespace app;

use app\helpers\Helper;

 class View {

     public $viewPath = '';

     use \app\traits\TSetGetMagic;

     public function __construct() {
         if (empty($this->viewPath))
             $cfg = Config::getConfig()['config'];
             $this->viewPath = $cfg['globalPath'] . $cfg['viewPath'];
     }

     public function display($view) {
         $view = Helper::handlerViewPath($view);
         echo $this->render($view);
     }

     public function render($view) {
         ob_start();
         include $view;
         $content = ob_get_contents();
         ob_end_clean();
         return $content;
     }

 }
 