<?php

namespace core;

use libraries\utils\YAMLViewConfiguration;
use Monolog\Logger;
use libraries\utils\Container;
use core\system\KernelEvents;
use core\http\HTTPRequest;
use exceptions\LangFileNotSpecifiedException;
use core\eventlisteners\Event;
use core\http\HTTPResponse;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;

class AbstractView
{
    protected $renderComplete = false;
    
    protected $templatePath = null;
    
    protected $logger = null;
    
    protected $ymlKey;
    
    protected $config;
    
    protected $agentType;
    
    protected $data = array();

    protected $container = null;

    protected $template = null;
    
    protected $langFileLoader = null;

    protected $localesList = null;
    
    protected $httpRequest = null;
    
    protected $httpResponse = null;
    
    public function __construct(Logger $logger, $ymlKey, array $agentType, HTTPRequest &$httpRequest, HTTPResponse &$httpResponse) {
        $this->logger = $logger;
        $this->ymlKey = $ymlKey;
        $this->agentType = $agentType;
        $this->langFileLoader = $httpRequest->getAttribute('langFiles');
        $this->localesList = $httpRequest->getAttribute('locales');
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        
        $this->loadConfig();

    }
    
    //injection method for overriding YML key when Exception occurs
    public function setYmlKey($ymlKey) {
        $this->ymlKey = $ymlKey;
        //assumes the override is allowed to be pre-loaded with the main config
        $this->config = $this->config[$ymlKey];
        
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
        $navigation = $this->httpRequest->getAttribute('NAVIGATION');
        
        if(!is_null($navigation)) {
            $data['NAVIGATION'] = $navigation;
        }
        $this->data = array_merge($data, $this->httpResponse->getAttributes());
       // $this->data = $data;       
    }

    public function getData() {
        return $this->data;
    }
    
    public function render( $data = array()) {
        
        //get any preloaded items that are in the Response object
        $data = array_merge((is_null($data) ? array() : $data), $this->httpResponse->getAttributes());
       
        //do any pre-render here - eg: format validation fail strings
        $params = new Event(KernelEvents::RESPONSE_START, $data);
        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::RESPONSE_START, $params);
        $this->container->get('EventDispatcher')->dispatch(__URI, KernelEvents::RESPONSE_START, $params);
        
        $this->setData($params->getParams());
        $this->renderView();
        
        //package the current output and send it to the eventdispatcher in case
        //there are any listeners requiring its content before we finalize the output
        $eventParams = array('content' => $this->template);
        $params = new Event(KernelEvents::RESPONSE_END, $eventParams);
        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::RESPONSE_END, $params);
        $eventParams = $params->getParams();
        $this->template = $eventParams['content'];
        
        $this->container->get('EventDispatcher')->dispatch(__URI, KernelEvents::RESPONSE_END);
        
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
       
        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();
        
        if(!is_null($userPreferences) && $userPreferences instanceof UserPreferences) {
            return array('locale' => $userPreferences->getDefaultLocale());
        }
              
        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }
    
    /**
     * getContent - used for pulling information from other uri calls.
     *              Useful for things like a blog feed embedded in a page
     * 
     * @param string $uri
     */
    public function getContentByUri($uri, $ssl = false) {
        $url =  $_SERVER['HTTP_HOST'] . $uri;
        $fullUrl = "http://$url";
        if($ssl) {
            $fullUrl = "https://$url";
        }
        
        return file_get_contents($fullUrl);
    }
    
    public function getContent($ymlkey, $params = array(), $ssl = false) {
        //website_blogs_feed
        $router = new system\Router($this->logger, $this->httpRequest);
        $qualifiedUrl = $router->getQualifiedUrl($ymlkey, $params);
        $url =  $_SERVER['HTTP_HOST'] . '/' . $qualifiedUrl;
        $fullUrl = "http://$url";
        if($ssl) {
            $fullUrl = "https://$url";
        }
        
        return file_get_contents($fullUrl);
        
    }
}
