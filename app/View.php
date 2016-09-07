<?php

 namespace app;

 class View {

     use \app\traits\TSetGetMagic;

     public function display($path) {
         require_once $path;
     }

 }
 