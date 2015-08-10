<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\controllers;

use core\AbstractController;
use core\components\widgets\serialization\WidgetPageSerializer;

/**
 * WidgetPagesController
 *
 * @author Dave Meikle
 */
class WidgetPagesController extends AbstractController {
    
    public function listTemplates() {
        $result = $this->httpRequest->getAttribute('PageTemplateDetails');
       
        $this->render($result);
        
    }
    
    public function savePageWidgets($pageId) {
        $result = $this->model->savePageWidgets($pageId);
        
    }
}
