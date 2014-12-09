<?php

namespace components\messaging\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;



/**
 * Description of PropertyModel
 *
 * @author davem
 */
class MessagingNotificationTemplateModel extends AbstractModel {
    
     public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'MessagingNotification';
        $this->tablename = 'messagingnotificationtemplates';
    }
}
    
    