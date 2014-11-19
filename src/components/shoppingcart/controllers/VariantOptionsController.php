<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class VariantOptionsController extends AbstractController
{
   
    public function getOptionsByVariantId($id) {
        $this->model->getOptionsByVariantId(intval($id));
    }
    
    public function editOption($groupId, $optionId) {
        $this->model->editOption($groupId, $optionId);
    }
    
    public function saveOption($groupId, $optionId) {
        $this->model->saveOption($groupId, $optionId);
    }
}
