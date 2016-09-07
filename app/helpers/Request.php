<?php

 namespace app\helpers;

 class Request {

     private $properties;
     private $feedback = [];

     public function __construct() {
         $this->init();
     }

     private function init() {
         if (isset($_SERVER['REQUEST_METHOD'])) {
//             $this->properties = $_REQUEST;
             $this->properties = ['post' => $_POST, 'get' => $_GET];
         }
     }
     
     function post($clean = FALSE) {
         if ($clean)
             $this->clean('post');
         return $this->properties['post'];
     }

     function get($clean = FALSE) {
         if ($clean)
             $this->clean('get');
         return $this->properties['get'];
     }

     private function clean($method) {
         if ($method === 'post') {
             foreach ($this->post as $k => $v) {
                 $this->properties['post'][$k] = filter_var($v);
             }
         } else {
             foreach ($this->get as $k => $v) {
                 $this->properties['get'][$k] = filter_var($v);
             }
         }
     }

     function getProperty($key) {
         if (isset($this->properties[$key]))
             return $this->properties[$key];
         return null;
     }

     function setProperty($key, $val) {
         $this->properties[$key] = $val;
     }

     function addFeedback($msg) {
         array_push($this->feedback, $msg);
     }

     function getFeedback() {
         return $this->feedback;
     }

     function getFeedbackString($separator = "\n") {
         return implode($separator, $this->feedback);
     }

     function getProperties() {
         return $this->properties;
     }


 }
 