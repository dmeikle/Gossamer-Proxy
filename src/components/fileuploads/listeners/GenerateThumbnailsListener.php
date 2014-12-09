<?php


namespace components\fileuploads\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of GenerateThumbnails
 *
 * @author davem
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
