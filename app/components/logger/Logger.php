<?php

 namespace app\components\logger;

use app\exceptions\FileException;

 /**
  * This Logger can be used to avoid conditional log calls.
  *
  * Logging should always be optional, and if no logger is provided to your
  * library creating a NullLogger instance to have something to throw logs at
  * is a good way to avoid littering your code with `if ($this->logger) { }`
  * blocks.
  */
 class Logger
        extends ALogger
 {

     /**
      * Logs with an arbitrary level.
      *
      * @param mixed  $level
      * @param string $message
      * @param array  $context
      *
      * @return null
      */
     public function log($level, $message, array $context = array())
     {
         $data = $this->logHandler($level, $message, $context);
         if (!file_put_contents($this->logPath, $data . PHP_EOL, FILE_APPEND))
             throw new FileException('Запись в лог не удалась');
     }

     private function logHandler($level, $message, $context)
     {
         $output = date('H:i:s d-m-Y') . PHP_EOL;
         $output .= 'Тип: ' . $level . PHP_EOL;
         $output .= 'Сообщение: ' . $message . PHP_EOL;
         $output .= implode(PHP_EOL, $context) . PHP_EOL;
         return $output;
     }

 }
 