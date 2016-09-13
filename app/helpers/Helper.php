<?php

 namespace app\helpers;

use Reflection;
use ReflectionClass;

 class Helper {

     public static function g($var) {
         echo '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/styles/default.min.css">
                <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/highlight.min.js"></script>
                <script>hljs.initHighlightingOnLoad();</script>';
         echo '<pre><code class="html" style="border: 1px solid black;">';
         if (is_array($var) || is_object($var)) {
             print_r($var);
             if (is_object($var)) {
                 $class = get_class($var);
                 Reflection::export(new ReflectionClass($class));
             }
         } else {
             echo htmlspecialchars($var);
         }
         echo '</code>';
     }

     /**
      * Преобразовывывет дату в привычный формат (2016-08-25 18:32:39 => 18:32:39 25-08-2016)
      * @param string $date
      * @return string преобразованная дата вида 
      */
     static public function dateConverter($date) {
         return date('d-m-Y H:i:s', strtotime($date));
     }
     

     static function redirect($path){
         header("Location: $path");
         exit;
     }
 }
 