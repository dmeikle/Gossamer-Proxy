<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

class EventNotificationModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'EventNotification';
        $this->tablename = 'eventnotifications';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    /**
     * overriding default since we are actually calling a list based on ID
     * 
     * @param int $id
     */
    public function edit($id) {
        $params = array('Events_id' => intval($id));
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        
        return $data;
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        return $data;
    }
}
