<?php

 namespace app\helpers;

use app\exceptions\MultiException;

 class Validator {

     public static function validateForm(array $data, array $reqired) {
         $mExc = new MultiException();
         foreach ($data as $k => $v) {
             if (in_array($k, $reqired) && empty($v))
                 $mExc[] = new \Exception('Поле "' . $k . '" обязательно к заполнению!');
         }
         return (count($mExc->data)) ? $mExc : NULL;
     }

 }
 