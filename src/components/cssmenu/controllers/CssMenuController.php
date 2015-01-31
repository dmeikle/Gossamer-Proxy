<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\cssmenu\controllers;

use core\AbstractController;
use core\components\locales\models\LocaleModel;

/**
 * CssMenuController
 *
 * @author Dave Meikle
 */
class CssMenuController extends AbstractController {
    
    /**
     * this method is initially written to display a menu for logged in
     * users. If you want to have a method for everyone..*coff coff*.. write 
     * another one...
     */
    public function view() {
        $locale = new LocaleModel($this->httpRequest, null, $this->logger);
        $locale->change($this->httpRequest->getQueryParameter('locale'));
        
        $contact = current($this->httpRequest->getAttribute('Contact'));
        
        if(intval($this->httpRequest->getQueryParameter('userid')) > 0) {
            $this->render($contact);
        }        
    }
}
