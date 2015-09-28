<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\controllers;

use core\AbstractController;

/**
 * CmsAdminMenuController
 *
 * @author Dave Meikle
 */
class CmsAdminMenuController extends AbstractController {
    
    
    /**
     * renders the page - we let the decisions of whether it's ALLOWED to be
     * shown to the user to be determined before this is called - use the
     * getContent(ymlkey) in AbstractView to have it managed.
     */
    public function getAdminMiniMenu($id) {
        
            $this->render(array('id' => $id));          
    }
    
}
