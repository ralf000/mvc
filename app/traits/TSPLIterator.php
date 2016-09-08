<?php

 namespace app\traits;

 trait TSPLIterator {
     
     public $position = 0;
     
     public function __construct() {
         $this->position = 0;
     }

     function rewind() {
         $this->position = 0;
     }

     function current() {
         return $this->array[$this->position];
     }

     function key() {
         return $this->position;
     }

     function next() {
         ++$this->position;
     }

     function valid() {
         return isset($this->array[$this->position]);
     }

 }
 