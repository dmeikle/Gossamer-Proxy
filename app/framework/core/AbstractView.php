<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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

/**
 * abstract view
 *
 * @author Dave Meikle
 */
class AbstractView {

    use \libraries\utils\traits\GetLoggedInUser;

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

    /**
     *
     * @param Logger $logger
     * @param string $ymlKey
     * @param array $agentType
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     */
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

    /**
     * injection method for overriding YML key when Exception occurs
     *
     * @param string $ymlKey
     */
    public function setYmlKey($ymlKey) {
        $this->ymlKey = $ymlKey;
        //assumes the override is allowed to be pre-loaded with the main config
        $this->config = $this->config[$ymlKey];
    }

    /**
     * used for getting a string value from a locale file based on its key
     *
     * @param string $key
     * @return string
     *
     * @throws LangFileNotSpecifiedException
     */
    public function getString($key) {
        if (is_null($this->langFileLoader)) {
            throw new LangFileNotSpecifiedException("LangFileLoader is null - cannot request a string. Check node configuration for langfile element");
        }

        return $this->langFileLoader->getString($key);
    }

    /**
     * accessor
     *
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;
    }

    /**
     * accessor
     *
     * @param array $data
     */
    public function setData($data) {
        //add the locales we preloaded here.
        ////TODO: we can begin to deprecate any other locale list calls
        $data['SystemLocalesList'] = $this->localesList;
        $navigation = $this->httpRequest->getAttribute('NAVIGATION');

        if (!is_null($navigation)) {
            $data['NAVIGATION'] = $navigation;
        }
        $modules = array('modules' => "'" . implode("','", $this->httpRequest->getModules()) . "'");

        $this->data = array_merge($data, $this->httpResponse->getAttributes(), $modules);

        if (!array_key_exists('componentFolder', $this->data)) {
            $this->data['componentFolder'] = __COMPONENT_FOLDER;
        }
        // $this->data = $data;
    }

    /**
     * accessor
     *
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * renders the results into a view
     *
     * @param array $data
     */
    public function render($data = array()) {

        //get any preloaded items that are in the Response object
        $data = array_merge(is_null($data) ? array() : $data, $this->httpResponse->getAttributes());

        //do any pre-render here - eg: format validation fail strings
        $params = new Event(KernelEvents::RESPONSE_START, $data);
        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::RESPONSE_START, $params);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::RESPONSE_START, $params);

        $this->setData($params->getParams());

        $this->renderView();

        //package the current output and send it to the eventdispatcher in case
        //there are any listeners requiring its content before we finalize the output
        $eventParams = array('content' => $this->template);
        $params = new Event(KernelEvents::RESPONSE_END, $eventParams);
        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::RESPONSE_END, $params);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::RESPONSE_END, $params);
        $eventParams = $params->getParams();
        $this->template = $eventParams['content'];
    }

    /**
     * to be called in child class
     */
    protected function renderView() {
        echo "rendering in parent";
    }

    /**
     * loads the configuration file
     */
    private function loadConfig() {
        $yamlConfig = new YAMLViewConfiguration($this->logger);
        $this->config = $yamlConfig->getViewConfig($_SERVER['REQUEST_URI'], $this->ymlKey);
        unset($yamlConfig);
    }

    /**
     * renders the page on the destruct
     */
    public function __destruct() {
        ob_start();
        if (!$this->renderComplete) {

            if (!is_null($this->data)) {
                try {
                    // The second parameter of json_decode forces parsing into an associative array
                    extract(json_decode(json_encode($this->data), true));
                } catch (\Exception $e) {
                    $this->logger->addError($e->getMessage());
                }
            }


            //extract($this->data->content);
            (eval("?>" . $this->template));
            $result = ob_get_clean();




            $this->template = '';
            $this->renderComplete = true;

            /**
             * CP-237 - added this event to be able to edit the output before we print to the page.
             * used for filtering out rendered elements based on permissions
             */
            $event = new Event(KernelEvents::RENDER_COMPLETE, $params);
            $event->setParams(array('renderedPage' => $result));
            $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::RENDER_COMPLETE, $event);
            $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::RENDER_COMPLETE, $event);
            $params = $event->getParams();


            //write it to the page - do not delete! this is not debug
            print($params['renderedPage']);
        }
    }

    /**
     * returns the currently logged in user's locale
     *
     * @return array
     */
    public function getDefaultLocale() {

        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();

        if (!is_null($userPreferences) && $userPreferences instanceof UserPreferences) {
            return array('locale' => $userPreferences->getDefaultLocale());
        }

        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }

    /**
     * makes a secondary URL call to the same server - can be called from the
     * view to increase throughput of browser calls and minimize single page
     * load events.
     *
     * @param string $ymlkey
     * @param array $params
     * @param boolean $ssl
     *
     * @return string
     */
    public function getContent($ymlkey, $params = array(), $ssl = false) {
        //website_blogs_feed
        $router = new system\Router($this->logger, $this->httpRequest);
        $qualifiedUrl = $router->getQualifiedUrl($ymlkey, $params);
        $url = $_SERVER['HTTP_HOST'] . '/' . $qualifiedUrl;
        $fullUrl = "http://$url";
        if ($ssl) {
            $fullUrl = "https://$url";
        }
        // $fullUrl .= '/' . implode('/', $params);

        $user = $this->getLoggedInUser();
        $userId = 0;
        if (is_object($user)) {
            $userId = $user->getId();
        }
        $locale = $this->getDefaultLocale();
        $params = http_build_query($params);

        return file_get_contents($fullUrl . '?userid=' . $userId . '&locale=' . $locale['locale'] . ((strlen($params) > 0) ? '&' . $params : ''));
    }

    /**
     * checks the access rights of the logged in user before deciding to
     * make the call for the menu content
     *
     * @param string $ymlkey
     *
     * @return string
     */
    public function getMenu($ymlkey, array $params = array()) {
        $manager = new navigation\MenuManager();

        if ($manager->checkAccessRights($ymlkey, $this->getLoggedInUser())) {

            return $this->getContent($ymlkey, $params);
        }
    }

}
