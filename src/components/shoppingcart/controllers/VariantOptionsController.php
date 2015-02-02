<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class VariantOptionsController extends AbstractController
{
   
    public function getOptionsByVariantId($id) {
        $result = $this->model->getOptionsByVariantId(intval($id));
        
        $this->render($result);
    }
    
    public function editOption($groupId, $optionId) {
        $result = $this->model->editOption($groupId, $optionId);
        
        $this->render($result);
    }
    
    public function saveOption($groupId, $optionId) {
        $result = $this->model->saveOption($groupId, $optionId);
        
        $this->render($result);
    }
}
