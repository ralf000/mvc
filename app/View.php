<?php

 namespace app;

 class View {

     use \app\traits\TSetGetMagic;

     public function display($view) {
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
 