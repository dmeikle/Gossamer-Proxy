<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\fileuploads\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

use components\claims\models\LocationsPhotos;

class FileUploadModel extends  AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'FileUpload';
        $this->tablename = 'fileuploads';        
    }

    public function save($id) {
      
        $images = $this->httpRequest->getAttribute('filenames');
        foreach($images as $image) {
            $this->saveImage($id, $image);
        }
        
        return array();
    }
    
    private function saveImage($locationId, $filename) {
        $image = file_get_contents($filename);
        $model = new LocationsPhotos($this->httpRequest, $this->httpResponse);
        $params = array('ClaimsLocations_id' => $locationId, 'photo' => $image);        
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params); 
    }
    
}
