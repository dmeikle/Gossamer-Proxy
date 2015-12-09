<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\documents\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of UploadDocumentsListener
 *
 * @author Dave Meikle
 */
class UploadDocumentsListener extends AbstractListener {

    public function on_request_start($params = array()) {

        $filenames = array();
        $requestParams = $this->httpRequest->getParameters();
        $locationId = $requestParams[0];
        $modelName = $this->listenerConfig['class'];
        $model = new $modelName($this->httpRequest, $this->httpResponse, $this->logger);

        $filepath =  $model->getUploadPath() . DIRECTORY_SEPARATOR . $locationId;   //__SITE_PATH . "/../locationImages/$locationId";
        $this->prepareDirectory($filepath);
        
        foreach ($_FILES['file']['name'] as $index => $file) {
           if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index])) {
                $filenames[] = $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index];
            } 
        }
        

        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }

    private function prepareDirectory($filepath) {

        if (!file_exists($filepath)) {
            if (!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        }
    }

}
