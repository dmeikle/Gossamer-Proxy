<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;

class ClaimContactModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ClaimContact';
        $this->tablename = 'claimscontacts';        
    }
    
    
    public function listall($offset = 0, $rows = 20, $customVerb = null) {
        return parent::listall($offset, $rows, 'listByClaim');
    }
    
    public function listallByClaim($jobNumber) {
        
        $params = array('jobNumber' => $jobNumber);
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByClaim', $params);
        
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
