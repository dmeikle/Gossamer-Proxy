<?php
namespace components\notifications\controllers;

use core\AbstractController;


/**
 * Description of NotificationsController
 *
 * @author davem
 */
class NotificationsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
}
