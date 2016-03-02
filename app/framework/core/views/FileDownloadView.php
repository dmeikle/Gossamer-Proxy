<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\views;

use core\AbstractView;

/**
 * FileDownloadView
 *
 * @author Dave Meikle
 */
class FileDownloadView extends AbstractView {

    /**
     * to be called in child class
     */
    protected function renderView() {

        if (!array_key_exists('content', $this->data)) {
//            error_log('not exists');
//            header("HTTP/1.0 404 Not Found");
//            header("Content-type: image/jpeg");
//            header('Content-Length: ' . filesize("404_files.jpg"));
//            header("Accept-Ranges: bytes");
//            header("Last-Modified: Fri, 03 Mar 2004 06:32:31 GMT");
//            readfile("404_files.jpg");
//            exit;
            throw new \Exception('content not found while rendering view');
        }
//        $extension = $this->getExtension($this->data['filename']);
//        switch ($extension) {
//            case "pdf":
//                header("Content-type: application/pdf");
//                break;
//        }

        header('Expires: 0'); // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Cache-Control: private', false);
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="' . $this->data['filename'] . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($this->data['content'])); // provide file size
        header('Connection: close');

        echo $this->data['content'];

        exit;
    }

    //need this to override the default destruct in parent class
    public function __destruct() {

    }

    private function getExtension($filename) {
        $pieces = explode('.', $filename);

        return array_pop($pieces);
    }

}
