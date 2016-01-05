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
        $locationId = intval($requestParams[0]);
        $modelName = $this->listenerConfig['class'];
        $model = new $modelName($this->httpRequest, $this->httpResponse, $this->logger);
        $post = $this->httpRequest->getPost();
        if (!$model instanceof \core\UploadableInterface) {
            throw new \Exception($modelName . ' must implement UploadableInterface');
        }

        $conn = $this->getDatasource($modelName);
        $model->setDatasource($conn);
        $filepath = $model->getUploadPath() . DIRECTORY_SEPARATOR . $locationId;   //__SITE_PATH . "/../locationImages/$locationId";
        $this->prepareDirectory($filepath);
        $params = array();
        foreach ($_FILES['file']['name'] as $index => $file) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index])) {
                $filenames[] = $filepath . DIRECTORY_SEPARATOR . $_FILES['file']['name'][$index];
                $params[] = array('Claims_id' => $locationId, 'filename' => $_FILES['file']['name'][$index], 'Staff_id' => $this->getLoggedInStaffId(), 'ClaimsLocations_id' => intval($post['ClaimsLocations_id']));
            }
        }
        unset($post);
        $count = $model->saveParamsOnComplete($params);

        if (array_key_exists('ClaimDocumentsCount', $count)) {
            $count = $count['ClaimDocumentsCount'][0]['rowCount'];
        }
        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
        $this->httpResponse->setAttribute('documentCount', $count);
    }

    private function prepareDirectory($filepath) {

        if (!file_exists($filepath)) {
            if (!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        }
    }

}
