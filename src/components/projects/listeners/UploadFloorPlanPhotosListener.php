<?php

namespace components\projects\listeners;


use core\eventlisteners\AbstractListener;


/**
 * Description of UploadLocationPhotosListener
 *
 * @author davem
 */
class UploadFloorPlanPhotosListener extends AbstractListener{
    
    public function on_request_start($params = array()) {
       
        $filenames = array();
        $requestParams = $this->httpRequest->getParameters();
        $projectId = $requestParams[0];
        
        $filepath = __SITE_PATH . "/web/images/floorplans/$projectId";
        $this->prepareDirectory($filepath);
        $this->prepareDirectory($filepath . '/thumbs');
        
        $newFilename = $this->randomString() . $this->getFileExtension($_FILES['FloorPlan']['type']['floorPlan']);
        if(move_uploaded_file($_FILES['FloorPlan']['tmp_name']['floorPlan'], $filepath . "/" .  $newFilename)) {
           $filenames[] = $filepath . "/" . $_FILES['FloorPlan']['name']['floorPlan'];           
        }
        //needed by thumbnail generator
        $this->httpRequest->setAttribute('filepath', $filepath);
        $this->httpRequest->setAttribute('newFilename', $newFilename);
        
        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }
   
    private function prepareDirectory($filepath) {
        echo $filepath;
        if (!file_exists($filepath)) {
            if(!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        } 
    }
    
    private function randomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        
        return $randstring;
    }
    
    private function getFileExtension($type) {
        if($type == 'image/png') {
            return '.png';
        } elseif($type == 'image/jpg') {
            return '.jpg';
        } elseif($type == 'image/gif') {
            return '.gif';
        }
    }
}
