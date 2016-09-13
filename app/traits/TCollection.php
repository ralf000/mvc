<?php

 namespace app\traits;

 trait TCollection {

     private $count = 0;
     public $data = [];
     public $position = 0;

//     arrayAcces interface
     public function offsetSet($offset, $value) {
         if (is_null($offset)) {
             $this->data[] = $value;
         } else {
             $this->data[$offset] = $value;
         }
     }

     public function offsetExists($offset) {
         return isset($this->data[$offset]);
     }

     public function offsetUnset($offset) {
         unset($this->data[$offset]);
     }

     public function offsetGet($offset) {
         return isset($this->data[$offset]) ? $this->data[$offset] : null;
     }

//     iterator interface
     function rewind() {
         $this->position = 0;
     }

     function current() {
         return $this->data[$this->position];
     }

     function key() {
         return $this->position;
     }

     function next() {
         ++$this->position;
     }

     function valid() {
         return isset($this->data[$this->position]);
     }

//     countable interface

     public function count() {
         return ++$this->count;
     }

 }
 