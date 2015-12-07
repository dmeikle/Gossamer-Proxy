<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\fileuploads\views;

use core\AbstractView;

/**
 * FileDownloadView
 *
 * @author Dave Meikle
 */
class FileDownloadView extends AbstractView {

    public function render($data = array()) {
        $file_url = __UPLOADED_FILES_PATH . $data['module'] . DIRECTORY_SEPARATOR . $data['filename'];

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");

        readfile($file_url); // do the double-download-dance (dirty but worky)
    }

}
