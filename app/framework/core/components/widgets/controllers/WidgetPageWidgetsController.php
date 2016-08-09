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

/**
 * WidgetPagesController
 *
 * @author Dave Meikle
 */
class WidgetPageWidgetsController extends AbstractController {

    public function listallByPage($pageId) {
        $result = $this->model->listallByPage(intval($pageId));

        $serializer = new \core\components\widgets\serialization\WidgetPageWidgetsSerializer();

        $this->render($serializer->formatResults($result));
    }

    public function deletePageWidget($ymlKey, $widgetId) {
        $result = $this->model->deletePageWidget($ymlKey, intval($widgetId));

        $this->render($result);
    }

}
