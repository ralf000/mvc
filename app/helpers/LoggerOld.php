<?php

 namespace app\helpers;

use app\Config;
use app\exceptions\FileException;

 class LoggerOld {

     private static $message = NULL;
     private static $logPath = NULL;

     private static function init() {
         if (is_null(self::$logPath))
             self::$logPath = Config::getConfig()['config']['logPath'] . 'log.txt';
     }

     public static function log($message) {
         self::init();
         if (is_object($message) && $message instanceof \Exception)
             $message = self::messageHandler($message);
         if (is_null(self::$message))
             self::$message = date('H:i:s d-m-Y') . PHP_EOL . $message;
         self::write(self::$message);
     }

     private static function write($data) {
         if (!file_put_contents(self::$logPath, $data . PHP_EOL, FILE_APPEND))
             throw new FileException('Запись в лог не удалась');
     }

     private static function messageHandler(\Exception $data) {
         return $data->getMessage() . PHP_EOL . 'File: ' . $data->getFile() . PHP_EOL . 'Line: ' . $data->getLine() . PHP_EOL;
     }

     public function __destruct() {
         self::$message = NULL;
     }

 }
 