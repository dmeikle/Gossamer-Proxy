<?php

namespace core\components\locales\controllers;

use core\AbstractController;

class LocaleController extends AbstractController
{
    
    public function change() {  
      
        $this->model->change();      
        $uri = $this->model->getHttpRequest()->getAttribute('HTTP_REFERER');
       
        $this->redirect(($uri));        
    }
    
    public function save($id) {  
      
        $this->model->save(intval($id));      
        
       
        $this->redirect('/admin/locales');        
    }
}
