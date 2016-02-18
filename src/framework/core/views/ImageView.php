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
 * ImageView
 *
 * @author Dave Meikle
 */
class ImageView extends AbstractView {

    /**
     * to be called in child class
     */
    protected function renderView() {

        $filepath = $this->data['filepath'];

        if (file_exists($filepath)) {

            $path_parts = pathinfo($filepath);

            switch (strtolower($path_parts['extension'])) {
                case "gif":
                    header("Content-type: image/gif");
                    break;
                case "jpg":
                case "jpeg":
                    header("Content-type: image/jpeg");
                    break;
                case "png":
                    header("Content-type: image/png");
                    break;
                case "bmp":
                    header("Content-type: image/bmp");
                    break;
            }

            header("Accept-Ranges: bytes");
            header('Content-Length: ' . filesize($filepath));
            header("Last-Modified: Fri, 03 Mar 2004 06:32:31 GMT");
            readfile($filepath);
            exit;
        } else {
            error_log('not exists');
            header("HTTP/1.0 404 Not Found");
            header("Content-type: image/jpeg");
            header('Content-Length: ' . filesize("404_files.jpg"));
            header("Accept-Ranges: bytes");
            header("Last-Modified: Fri, 03 Mar 2004 06:32:31 GMT");
            readfile("404_files.jpg");
            exit;
        }
    }

    //need this to override the default destruct in parent class
    public function __destruct() {

    }

}
