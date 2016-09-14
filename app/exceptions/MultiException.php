<?php

 namespace app\exceptions;

 use ArrayAccess;
 use Countable;
 use Iterator;

 class MultiException
        extends BaseException
        implements ArrayAccess, Iterator, Countable
 {

     use \app\traits\TCollection;
 }
 