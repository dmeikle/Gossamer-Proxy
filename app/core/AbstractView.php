<?php

namespace core;

use libraries\utils\YAMLViewConfiguration;
use Monolog\Logger;
use libraries\utils\Container;
use core\system\KernelEvents;

class AbstractView
{
    
    protected $templatePath = null;
    
    protected $logger = null;
    
    protected $ymlKey;
    
    protected $config;
    
    
    private $data = array();

    protected $container = null;
    
    public function __construct(Logger $logger, $ymlKey) {
        $this->logger = $logger;
        $this->ymlKey = $ymlKey;
        $this->loadConfig();
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }
    
    public function render( $data= array()) {
       
        $this->container->get('EventDispatcher')->dispatch(KernelEvents::RESPONSE_START, 'response_begin');
        
        $this->setData($data);
        $this->renderView();
        
        $this->container->get('EventDispatcher')->dispatch(KernelEvents::RESPONSE_END, 'response_end');
        
    }
    
    protected function renderView() {
        echo "rendering in parent";
    }
    
    private function loadConfig() {
        $yamlConfig = new YAMLViewConfiguration($this->logger);
        $this->config = $yamlConfig->getViewConfig($_SERVER['REQUEST_URI'], $this->ymlKey);
        unset($yamlConfig);
    }
    
    
    public function __destruct()
    {
        if(!is_null($this->data)) {
            try{
                // The second parameter of json_decode forces parsing into an associative array
                extract(json_decode(json_encode($this->data), true));            
            }catch(\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }
        
        //extract($this->data->content);
        eval("?>" . $this->template . "<?");
    }
}
