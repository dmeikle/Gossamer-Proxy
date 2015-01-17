<?php

namespace components\contactus\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of ContactUsTypeModel
 *
 * @author davem
 */
class ContactUsTypeModel extends AbstractModel implements FormBuilderInterface{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ContactUsType';
        $this->tablename = 'contactustypes';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
