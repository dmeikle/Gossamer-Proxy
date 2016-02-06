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

    public function sendFile() {
        $fileList = $this->httpRequest->getQueryParameter('files');
        $type = $this->getType($fileList);
        if (is_null($type)) {
            throw new \Exception('Unable to determine file type');
        }
        $concat = $this->model->loadFiles($fileList, $type);

        $this->render(array('contents' => $concat, 'type' => $type));
    }

    private function getType($fileList) {
        $type = substr($fileList, strlen($fileList) - 4);
        if ($type == '.css') {
            return 'css';
        } elseif (substr($type, 1) == '.js') {
            return 'js';
        }

        return null;
    }

}
