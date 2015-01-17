<?php


namespace core;

use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\AbstractView;
use core\datasources\DataSourceInterface;
use libraries\utils\Container;
use core\http\HTTPSession;
use libraries\utils\Pagination;
use Gossamer\Caching\CacheManager;
use core\components\mappings\models\MappingModel;
use libraries\utils\preferences\UserPreferencesManager;
use libraries\utils\preferences\UserPreferences;

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
    

    protected function isFailedValidationAttempt() {
        return !is_null($this->httpRequest->getAttribute('ERROR_RESULT'));
    }
    

    public function getComponentName() {
        $pieces = explode(DIRECTORY_SEPARATOR, $this->childNamespace);
        array_pop($pieces);
        
        return array_pop($pieces);
    }
    
    function getTablename() {
        return $this->tablename;    
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
    
    
    
    public function setDataSource(DataSourceInterface $dataSource) {
        $this->dataSource = $dataSource;
    }

    public function index(array $params) {
        return $params;
    }
    
    public function listallArray($offset = 0, $rows = 20) {
        $params = array(
            'offset' => $offset, 'rows' => $rows
        );


        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    }
    

    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        return $data;
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = null) {
       
        return $this->listallWithParams($offset, $rows, array(), $customVerb);
    }
    
    public function listallWithParams($offset = 0, $rows = 20, array $params, $customVerb = null) {
        
        $params['directive::OFFSET'] = $offset;
        $params['directive::LIMIT'] = $rows;
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, (is_null($customVerb) ? self::VERB_LIST : $customVerb), $params);
    
        return $data; 
    }
    
    public function edit($id) {
    

        if($this->isFailedValidationAttempt()) {
           
            return $this->httpRequest->getAttribute('POSTED_PARAMS');
        }

        $params = array(
            'id' => intval($id)
        );
     
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
       
        if(is_array($data) && array_key_exists($this->entity, $data)) {
            $data = current($data[$this->entity]);
        }
        
        return $data;
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
    
    

    protected function getFileList($dir, $recurse=false)
    {
        # array to hold return value
        $retval = array();

        # add trailing slash if missing
        if(substr($dir, -1) != "/") $dir .= "/";

        # open pointer to directory and read list of files
        $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
        while(false !== ($entry = $d->read())) {
            # skip hidden files
            if($entry[0] == "." || strpos($entry[0],'thumbnails')) continue;
            if(is_dir("$dir$entry")) {
                $retval[] = array(
                    "name" => "$entry/",
                    "type" => filetype("$dir$entry"),
                    "size" => 0,
                    "lastmod" => filemtime("$dir$entry")
                );
                if($recurse && is_readable("$dir$entry/")) {
                    $retval = array_merge($retval, getFileList("$dir$entry/", true));
                }
            } elseif(is_readable("$dir$entry")) {
                $retval[] = array(
                    "name" => "$entry",
                    "type" => mime_content_type("$dir$entry"),
                    "size" => filesize("$dir$entry"),
                    "lastmod" => filemtime("$dir$entry")
                );
            }
        }
        $d->close();

        return $retval;
    }

    protected function formatSelectionBoxOptions(array $options, array $selectedOptions, $subKey = '') {
        
        if(strlen($subKey) > 0) {           
            $options = $this->extractSubNode($options, $subKey);          
        }
        
        $retval = '';
        foreach($options as $key => $option) {
            if(!in_array($key, $selectedOptions)) {
                $retval .= "<option value=\"{$key}\">{$option}</option>\r\n";
            } else {
                $retval .= "<option value=\"{$key}\" selected>{$option}</option>\r\n";
            }
        }
        
       
        return $retval;
    }
    
    /**
     * navigates the sub arrays to extract the child elements by subkey
     * @param array $array
     * @param type $key
     * 
     * @return array
     */
    private function extractSubNode(array $array, $key) {
       
        $output = array();
        foreach($array as $row) {
            $output[$row['id']] = $row[$key];
        }
        
        return $output;
    }
    
    
    public function getHttpRequest() {
        return $this->httpRequest;
    }
    

    public function getHttpResponse() {
        return $this->httpResponse;
    }

    protected function getPagination($rawRowCount, $offset, $limit) {
        if(is_null($rawRowCount)) {
            return;
        }
      
        $pagination = new Pagination($this->logger);
        $rowCount2 = array_shift($rawRowCount);
       
        $rowCount = $rowCount2['rowCount'];
       
        $retval = $pagination->getPagination($rowCount, $offset, $limit);
       
        return $retval;
    }
    
    protected function getSecurityToken() {
        $serializedToken = getSession('_security_secured_area');
        $token = unserialize($serializedToken);
        
        return $token;
    }
    
    
    public function getLoggedInStaffId() {
        $token = $this->getSecurityToken();
        
        return $token->getClient()->getId();
    }
    
    public function getEmptyModelStructure() {
        $key = 'mappings_' . $this->getComponentName() . '_' . $this->entity;
        $cacheManager = new CacheManager($this->logger);
        $structure = $cacheManager->retrieveFromCache($key);
        
        if(!$structure) {            
            $params = array('entity' => $this->entity,
                'component' => $this->getComponentName());

            $structure = $this->dataSource->query(self::METHOD_GET, new MappingModel($this->httpRequest, $this->httpResponse, $this->logger), self::VERB_GET, $params);  
            $cacheManager->saveToCache($key, $structure);
        }
        
        return $structure;
    }

}
