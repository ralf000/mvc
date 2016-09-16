<?php

 namespace app\admin\components;

 class AdminDataTable
 {

     private $models = [];
     private $functions = [];
     private $thead = [];

     public function __construct(array $models, array $functions, array $thead)
     {
         if (empty($this->models))
             $this->models = $models;
         if (empty($this->functions))
             $this->functions = $functions;
         if (empty($this->thead))
             $this->thead = $thead;
     }

     public function render()
     {
         $output = '';
         $output .= '<table class="table table-bordered">' . "\n";
         $thead = '';
         foreach ($this->thead as $cell)
             $thead .= "<th>$cell</th>";
         $output .= $thead;
         foreach ($this->models as $model) {
             $output .= "<tr>\n";
             foreach ($this->functions as $function) {
                 $a = $function($model);
                 $output .= "<td>{$a[key($a)]}</td>\n";
             }
             $output .= "</tr>\n";
         }
         $output .= "</table>\n";
         return $output;
     }

 }
 