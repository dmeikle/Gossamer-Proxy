<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimPhotosController extends AbstractController
{
   
    public function getCount($jobNumber) {
        $params = array('jobNumber' => $jobNumber, 'key' => 'claims_photos_count');
        $result = $this->model->getCount($params);
        
        $this->render($result);
    }
    
    public function listByClaimId($jobNumber) {
       
        $result = $this->model->listByClaimId($jobNumber);
        $result['claim']['jobNumber'] = $jobNumber;
        
        $this->render($result);
    }
    
    public function drawParams($id) {
       
        $jobNumber = preg_replace("/[^a-z0-9\s\-]/i", "", $id); 
        $params = array('claim' => array('jobNumber' => $jobNumber));
       
        $this->render($params);
    }
   
    public function uploadPhotos($jobNumber, $locationId = 0) {
        $filenames = array();
        $claimImagePath = __UPLOADED_IMAGES_PATH . 'claims' . DIRECTORY_SEPARATOR . $jobNumber . DIRECTORY_SEPARATOR;
        
        if(intval($locationId) > 0) {
            $claimImagePath .= intval($locationId) . DIRECTORY_SEPARATOR;
        }
        
        $this->mkdir($claimImagePath);
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $claimImagePath . $_FILES['file']['name'])) {
            $params = array('id' => intval($id), 'imageName' => $_FILES['file']['name']);
            
            $this->model->saveParams($params);         
        }
       
       $this->render(array('success' => 'true'));
    }
   
    
    /**
     * Creates a directory recursively.
     *
     * @param string|array|\Traversable $dirs The directory path
     * @param int                       $mode The directory mode
     *
     * @throws IOException On any directory creation failure
     */
    private function mkdir($dirs, $mode = 0777)
    {
        foreach ($this->toIterator($dirs) as $dir) {
            if (is_dir($dir)) {
                continue;
            }

            if (true !== @mkdir($dir, $mode, true)) {
                $error = error_get_last();
                if (!is_dir($dir)) {
                    // The directory was not created by a concurrent process. Let's throw an exception with a developer friendly error message if we have one
                    if ($error) {
                        throw new IOException(sprintf('Failed to create "%s": %s.', $dir, $error['message']), 0, null);
                    }
                    throw new IOException(sprintf('Failed to create "%s"', $dir), 0, null);
                }
            }
        }
    }
    
    /**
     * @param mixed $files
     *
     * @return \Traversable
     */
    private function toIterator($files)
    {
        if (!$files instanceof \Traversable) {
            $files = new \ArrayObject(is_array($files) ? $files : array($files));
        }

        return $files;
    }
}
