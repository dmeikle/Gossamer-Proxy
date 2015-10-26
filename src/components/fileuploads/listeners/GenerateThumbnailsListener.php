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

/**
 * Description of GenerateThumbnails
 *
 * @author Dave Meikle
 */
class GenerateThumbnailsListener extends AbstractListener {

    public function on_request_start($params = array()) {

        $filename = $this->httpRequest->getAttribute('newFilename');

        $cmd = "convert -thumbnail 200 " . $this->httpRequest->getAttribute('filepath') . DIRECTORY_SEPARATOR .
                "$filename " . $this->httpRequest->getAttribute('filepath') . DIRECTORY_SEPARATOR . "thumbs/$filename";

        exec($cmd);

        $this->httpRequest->setAttribute('uploadedFile', $filename);
    }

}
