<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of UploadLocationPhotosListener
 *
 * @author Dave Meikle
 */
class UploadLocationPhotosListener extends AbstractListener {

    public function on_request_start($params = array()) {

        $filenames = array();
        $requestParams = $this->httpRequest->getParameters();
        $locationId = intval($requestParams[0]) . '/' . intval($requestParams[1]);
        $modelName = $this->listenerConfig['class'];
        $model = new $modelName($this->httpRequest, $this->httpResponse, $this->logger);

        $conn = $this->getDatasource($modelName);
        $model->setDatasource($conn);

        $filepath = $model->getUploadPath() . DIRECTORY_SEPARATOR . $locationId;   //__SITE_PATH . "/../locationImages/$locationId";
        $this->prepareDirectory($filepath);
        $params = array();
        foreach ($_FILES['file']['name'] as $index => $file) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index])) {
                $filenames[] = $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index];
                $params[] = array('Claims_id' => intval($requestParams[0]), 'ClaimsLocations_id' => intval($requestParams[1]),
                    'photo' => $_FILES['file']['name'][$index], 'Staff_id' => $this->getLoggedInStaffId());
            }
        }


        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
        $this->httpResponse->setAttribute('fileCount', $model->saveParamsOnComplete($params));
    }

    private function prepareDirectory($filepath) {

        if (!file_exists($filepath)) {
            if (!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        }
    }

}
