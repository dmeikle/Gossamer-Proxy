<?php


namespace core;

use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\AbstractView;
use core\datasources\DataSourceInterface;
use libraries\utils\Container;


class AbstractModel
{
    
    protected $view = null;

    protected $dataSource = null;
    
    protected $datasourcekey;

    protected $navigation = null;
    
    protected $httpRequest = null;
    
    protected $httpResponse = null;
    
    protected $container = null;
    
    protected $logger = null;
    
    /**
     * property: lang
     * used for loading locale strings
     */
    protected $lang = null;

    const METHOD_DELETE = 'delete';

    const METHOD_SAVE = 'save';

    const METHOD_PUT = 'put';

    const METHOD_POST = 'post';

    const METHOD_GET = 'get';
    
    const VERB_LIST = 'list';
    
    const VERB_DELETE = 'delete';
    
    const VERB_GET = 'get';
    
    const VERB_SAVE = 'save';
    
    const DIRECTIVES = 'directives';
    
    protected $entity;
    
    protected $childNamespace;
    
    protected $tablename;
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {      
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->logger = $logger;
        $this->entity = get_called_class();
    }
    
    public function getComponentName() {
        $pieces = explode(DIRECTORY_SEPARATOR, $this->childNamespace);
        array_pop($pieces);
        
        return array_pop($pieces);
    }
    
    function getTablename() {
        return $this->tablename;    
    }
    
    public function setView(AbstractView $view) {
        $this->view = $view;
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    public function getEntity($stripNamespace = false) {
        if($stripNamespace) {
            $pieces = explode('\\', $this->entity);
            
            return array_pop($pieces);
        }
        return $this->entity;
    }
    
    
    protected function render(array $data = null) {
        $this->view->render($data);
    } 
    
    public function setDataSource(DataSourceInterface $dataSource) {
        $this->dataSource = $dataSource;
    }
    
    public function listall($offset = 0, $rows = 20) {
        $params = array(
            'offset' => $offset, 'rows' => $rows
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        $this->render($data);
    }
    
    public function edit($id) {
        $params = array(
            'id' => intval($id)
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
     
        $this->render($data);
    }
    
}
