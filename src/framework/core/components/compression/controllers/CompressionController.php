<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\compression\controllers;

use core\AbstractController;

/**
 * CompressionController
 *
 * @author Dave Meikle
 */
class CompressionController extends AbstractController {

    public function sendJSFile() {
        $fileList = $this->httpRequest->getQueryParameter('files');

        $concat = $this->model->loadFiles($fileList, 'js');

        $this->render(array('contents' => $concat, 'type' => 'js'));
    }

    public function sendCSSFile() {
        $fileList = $this->httpRequest->getQueryParameter('files');

        $concat = $this->model->loadFiles($fileList, 'css');

        $this->render(array('contents' => $concat, 'type' => 'css'));
    }

}
