<?php
namespace components\surveys\controllers;


use core\AbstractController;

/**
 * Description of SheetSelectionsController
 *
 * @author davem
 */
class AnswersController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
}
