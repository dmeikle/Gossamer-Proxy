<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\fileuploads\listeners;

use core\eventlisteners\AbstractListener;

class UploadFilesListener extends AbstractListener {

    public function on_request_start($params = array()) {
        $filenames = array();

        if (move_uploaded_file($_FILES['file']['tmp_name'], __SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . "/uploads/" . $_FILES['file']['name'])) {
            $filenames[] = __SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . "/uploads/" . $_FILES['file']['name'];
        }

        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }

}
