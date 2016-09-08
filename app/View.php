<?php

 namespace app;

 class View {

     private $cfg = NULL;
     public $viewPath = '';

     use \app\traits\TSetGetMagic;

     public function __construct() {
         if (empty($this->viewPath)) {
             $this->cfg = Config::getConfig()['config'];
             $this->viewPath = $this->cfg['viewPath'];
         }
     }

     public function display($view) {
         $view = $this->viewPathHandler($view);
         echo $this->render($view);
     }

     public function render($view) {
         ob_start();
         include $view;
         $content = ob_get_contents();
         ob_end_clean();
         return $content;
     }

     private function viewPathHandler($view) {
         if (substr($view, 0, 1) !== '/')
             $view = '/' . $view;
         foreach ($this->cfg['avaliableExtensions'] as $ext) {
             if (strpos($view, '.' . $ext) !== FALSE)
                 return $this->viewPath . $view;
         }
         $view .= '.php';
         return $this->viewPath . $view;
     }

 }
 