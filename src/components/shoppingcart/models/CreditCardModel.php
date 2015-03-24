<?php

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;


class CreditCardModel extends AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CreditCard';
        $this->tablename = 'cartproducts';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
