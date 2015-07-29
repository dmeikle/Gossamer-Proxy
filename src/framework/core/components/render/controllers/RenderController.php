<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\render\controllers;

use core\AbstractController;

/**
 * RenderController
 *
 * @author Dave Meikle
 */
class RenderController extends AbstractController {
    
    public function renderFile($component, $filename) {
       
        $html = $this->httpRequest->getAttribute($this->getKey());
     
        $this->render(array('html' => $html));
    }
    
    private function getKey() {
       
        list($widget, $file) = $this->httpRequest->getParameters();
        $locale = $this->getDefaultLocale();
        $key = DIRECTORY_SEPARATOR . 'render' . DIRECTORY_SEPARATOR . $widget . DIRECTORY_SEPARATOR . $file . '_' . $locale['locale'];
     
        return $key;

    }
}
