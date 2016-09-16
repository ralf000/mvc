<?php

 namespace app;

use app\common\controllers\FrontController;
use Twig_Environment;
use Twig_Loader_Filesystem;

 class View {

     private $cfg = NULL;
     public $viewPath = '';

     use \app\traits\TSetGetMagic;

     public function __construct() {
         if (empty($this->viewPath)) {
             $this->cfg = Config::getConfig()['config'];
             if (FrontController::isAdminPanel())
                 $this->viewPath = $this->cfg['adminViewPath'];
             else
                 $this->viewPath = $this->cfg['viewPath'];
         }
     }

     public function display($view) {
         $view = $this->viewPathHandler($view);
         echo $this->render($view);
     }

     public function render($view) {
         ob_start();
         require_once $view;
         $content = ob_get_contents();
         ob_end_clean();
         return $content;
     }

     private function viewPathHandler($view) {
         foreach ($this->cfg['avaliableExtensions'] as $ext) {
             if (strpos($view, '.' . $ext) !== FALSE)
                 return $this->viewPath . $view;
         }
         $view .= '.php';
         return (FrontController::isAdminPanel()) ?  $this->cfg['viewPath'] . $view : $this->viewPath . $view;
     }

 }
 