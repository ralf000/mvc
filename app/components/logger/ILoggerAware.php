<?php

 namespace app\components\logger;

 /**
  * Describes a logger-aware instance.
  */
 interface ILoggerAware
 {

     /**
      * Sets a logger instance on the object.
      *
      * @param LoggerInterface $logger
      *
      * @return null
      */
     public function setLogger(ILogger $logger);
 }
 