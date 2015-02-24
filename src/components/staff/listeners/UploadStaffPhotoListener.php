<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;


/**
 * Description of UploadLocationPhotosListener
 *
 * @author Dave Meikle
 */
class UploadStaffPhotoListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        
        $filenames = array();
        $requestParams = $this->httpRequest->getParameters();
        $locationId = $requestParams[0] . '/' . $requestParams[1];
        pr($requestParams);
        die;
        $filepath = __SITE_PATH . "/../locationImages/$locationId";
        $this->prepareDirectory($filepath);
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath . "/" . $_FILES['file']['name'])) {
           $filenames[] = $filepath . "/" . $_FILES['file']['name'];           
        }
       
        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }
   
    private function prepareDirectory($filepath) {
        
        if (!file_exists($filepath)) {
            if(!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        } 
    }
}
