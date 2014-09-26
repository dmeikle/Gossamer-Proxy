<?php

namespace core;

use libraries\utils\YAMLViewConfiguration;
use Monolog\Logger;
use libraries\utils\Container;
use core\system\KernelEvents;
use core\components\locales\utils\LocaleLoader;
use core\http\HTTPRequest;
use exceptions\LangFileNotSpecifiedException;


class AbstractView
{
    protected $renderComplete = false;
    
    protected $templatePath = null;
    
    protected $logger = null;
    
    protected $ymlKey;
    
    protected $config;
    
    protected $agentType;
    
    private $data = array();

    protected $container = null;

    protected $template = null;
    
    protected $langFileLoader = null;

    protected $localesList = null;
    
    protected $httpRequest = null;
    
    public function __construct(Logger $logger, $ymlKey, array $agentType, HTTPRequest $httpRequest) {
        $this->logger = $logger;
        $this->ymlKey = $ymlKey;
        $this->agentType = $agentType;
        $this->langFileLoader = $httpRequest->getAttribute('langFiles');
        $this->localesList = $httpRequest->getAttribute('locales');
        $this->httpRequest = $httpRequest;
        
        $this->loadConfig();

    }
    public function getString($key) {
        if(is_null($this->langFileLoader)) {
            throw new LangFileNotSpecifiedException("LangFileLoader is null - cannot request a string. Check node configuration for langfile element");
        }
        
        return $this->langFileLoader->getString($key);
    }
    
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    
    public function setData($data)
    {
        //add the locales we preloaded here. 
        ////TODO: we can begin to deprecate any other locale list calls
        $data['SystemLocalesList'] = $this->localesList;
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
        if(!$this->renderComplete) {
       
            if(!is_null($this->data)) {
                try{
                    // The second parameter of json_decode forces parsing into an associative array
                    extract(json_decode(json_encode($this->data), true));            
                }catch(\Exception $e) {
                    $this->logger->addError($e->getMessage());
                }
            }
         

            //extract($this->data->content);
            eval("?>" . $this->template ); 
            $this->template = '';
            $this->renderComplete = true;
            $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'render_complete');
        }
       
    }

    public function getDefaultLocale() {
       // $userPreferences = $this->httpRequest->getParameter('userPreferences');
        $userPreferences = getSession('userPreferences');
        if(!is_null($userPreferences) && array_key_exists('defaultLocale', $userPreferences)) {
           
            return $userPreferences['defaultLocale'];
        }
        
        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }
}
