<?php

namespace components\defaultItem\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;


class AboutModel extends  AbstractModel
{
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Default';
    }
    
    public function index() {
        $params = array(
            'filepath' => __SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'components'
             . DIRECTORY_SEPARATOR . 'defaultItem' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'about.php' 
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    
        $this->render($data);
    }
}
