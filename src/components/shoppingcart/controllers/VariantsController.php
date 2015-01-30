<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;
use components\shoppingcart\models\VariantOptionModel;

class VariantsController extends AbstractController
{
    public function edit($id) {
//        //ok - this is a 2 step process. we want to get the variant category,
//        // then get the options within.
//        $variant = $this->model->get(intval($id));
//        $optionsModel = new VariantOptionModel();
//        $options = $optionsModel->getByCategoryId($id);
        $result = $this->model->edit($id);
        
        $this->render($result);
    }
    
    public function getOptionsByVariantId($id) {
        $result = $this->model->getOptionsByVariantId(intval($id));
        
        $this->render($result);
    }
    
    public function listAllVariantsAndOptions($productId) {
        $result = $this->model->getAllVariantsForListing($productId);
        
        $this->render($result);
    }
    
    public function saveAllVariantsAndOptions($id) {
        $this->model->saveAllVariantsAndOptions($id);
        
        $this->render($result);
    }
}
