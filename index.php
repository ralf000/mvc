<?php

 require __DIR__ . '/autoload.php';

 function g($var) {
     echo '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/styles/default.min.css">
                <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/highlight.min.js"></script>
                <script>hljs.initHighlightingOnLoad();</script>';
     echo '<pre><code class="html" style="border: 1px solid black;">';
     if (is_array($var)) {
         print_r($var);
     } elseif (is_object($var)) {
         $class = get_class($var);
         Reflection::export(new ReflectionClass($class));
     } else {
         echo htmlspecialchars($var);
     }
     echo '</code>';
 }

 try {
     app\models\News::delete(14);
 } catch (Exception $ex) {
     echo $ex->getMessage();
 }