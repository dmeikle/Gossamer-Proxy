<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\blogs\controllers;

use core\AbstractController;

/**
 * BlogAdminMenuController
 *
 * @author Dave Meikle
 */
class BlogAdminMenuController extends AbstractController {

    use \libraries\utils\traits\LoadConfigFile;

    /**
     * renders the page - we let the decisions of whether it's ALLOWED to be
     * shown to the user to be determined before this is called - use the
     * getContent(ymlkey) in AbstractView to have it managed.
     */
    public function getAdminMiniMenu($id) {

        $this->render(array('id' => $id));
    }

}
