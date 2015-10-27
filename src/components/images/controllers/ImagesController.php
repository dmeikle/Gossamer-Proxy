<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\images\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\incidents\form\SectionBuilder;
use core\system\Router;

/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ImagesController extends AbstractController {

    public function serveImage() {


        $fullPath = __UPLOADED_IMAGES_PATH . $this->httpRequest->getQueryParameter('image');

        $this->render(array('filepath' => $fullPath));
    }

}
