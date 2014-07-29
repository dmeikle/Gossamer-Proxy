<?php


namespace core;

use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\AbstractView;
use core\datasources\DataSourceInterface;
use libraries\utils\Container;
use core\http\HTTPSession;

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

    public function listallArray($offset = 0, $rows = 20) {
        $params = array(
            'offset' => $offset, 'rows' => $rows
        );


        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    }
    public function listall($offset = 0, $rows = 20) {
        $params = array(
            'offset' => $offset, 'rows' => $rows
        );
        $params['locale'] = $this->getDefaultLocale();
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

    public function getDefaultLocale() {
        $userPreferences = $this->httpRequest->getParameter('userPreferences');
        if(!is_null($userPreferences) && array_key_exists('defaultLocale', $userPreferences)) {
            return $userPreferences['defaultLocale'];
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

    protected function formatSelectionBoxOptions(array $options, array $selectedOptions) {
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
    
     public function getSession($key) {
        $session = $_SESSION;
       
        return $this->fixObject($session[$key]);
    }
    
    public function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    private function fixObject (&$object)
    {
        if (!is_object ($object) && gettype ($object) == 'object'){
            
            return ($object = unserialize (serialize ($object)));
        }
        
        return $object;
    }
}
