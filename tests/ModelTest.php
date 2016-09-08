<?php

 namespace app\tests;

use app\models\News;
use Exception;

require_once dirname(__DIR__) . '/autoload.php';

 class ModelTest {

     private $model = NULL;
     private $class = NULL;
     private $id;

     public function __construct($model) {
         if (is_null($this->model))
             $this->model = $model;
         if (is_null($this->class))
             $this->class = get_class($model);
     }

     public function run() {
         $this->insertTest();
         $this->updateTest();
         $this->findByIdTest();
         $this->findAllTest();
         $this->deleteTest();
     }

     public function insertTest() {
         $this->model->title = 'блабла';
         $this->model->description = 'блабла';
         $this->model->content = 'блабла';
         if (!$this->model->save())
             throw new Exception('Не удалось сохранить модель в бд');
         $this->getIdTest();
     }
     
     public function updateTest() {
         $this->model->title = 'блабла222';
          if (!$this->model->save())
             throw new Exception('Не удалось обновить модель в бд');
     }

     public function findByIdTest() {
         $class = $this->class;
         $result = $class::findById($this->id);
         if (!$result)
             throw new Exception('Ошибка метода "findById". Не удалось получить, только что добавленную, модель');
     }

     public function findAllTest() {
         $class = $this->class;
         $result = $class::findAll();
         if (!$result)
             throw new Exception('Ошибка метода "findAll". Не удалось получить все модели');
     }

     public function deleteTest() {
         if (!$this->model->delete($this->id))
             throw new Exception('Не удалось удалить модель');
     }

     private function getIdTest() {
         $this->id = $this->model->id;
         if (!$this->id)
             throw new Exception('Не удалось получить id сохранной модели');
     }

 }

 try {
     $modelTest = new ModelTest(new News);
     $modelTest->run();
 } catch (Exception $ex) {
     echo $ex->getMessage();
 }
 