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
        $this->model->edit($id);
    }
    
    public function getOptionsByVariantId($id) {
        $this->model->getOptionsByVariantId(intval($id));
    }
    
    public function listAllVariantsAndOptions($id) {
        $this->model->getAllVariantsForListing();
    }
    
    public function saveAllVariantsAndOptions($id) {
        $this->model->saveAllVariantsAndOptions($id);
    }
}
