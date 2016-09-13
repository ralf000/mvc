<?php

 namespace app\exceptions;

 use app\helpers\Helper;
 use Exception;

 abstract class BaseException extends Exception {
     
     public function getException() {
         $output = get_class($this)  . '<br>';
         $trace = "<table>{$this->xdebug_message}</table>";
         return $output;
     }

 }
 