<?php

namespace core\datasources;

use core\datasources\DataSourceInterface;
use core\RestClient;
use libraries\utils\YAMLCredentialsConfiguration;
use Monolog\Logger;
use core\AbstractModel;

class RestDataSource implements DataSourceInterface
{
    private $logger = null;
    
    private $keyname = null;
    
    
    const METHOD_DELETE = 'delete';

    const METHOD_SAVE = 'save';

    const METHOD_PUT = 'put';

    const METHOD_POST = 'post';

    const METHOD_GET = 'get';
    
    const VERB_LIST = 'list';
    
    const VERB_DELETET = 'delete';
    
    const VERB_GET = 'get';
    
    const VERB_SAVE = 'save';
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function setDatasourceKey($keyName) {
        $this->keyname = $keyName;
    }
  
    private function getEntityName(AbstractModel $entity) {
        $pieces = explode('\\', get_class($entity));
        
        return array_pop($pieces);
    }

    
    /**
     * query - main execution point for retrieving data from the remote database
     *
     * @param string queryType (get, post, delete, put)
     * @param string entity - the mapped name of the table to access
     * @param string verb   - which action to perform
     * @param array params  - passed in variables to work with on the DB side
     *
     * @return array
     */
    public function query($queryType, AbstractModel $entity, $verb, $params) {
        $ymlKey = $this->keyname;
     
        $configParams = $this->getCredentials($ymlKey);
       
        $credentials = $configParams['credentials'];
        
        $api = new RestClient(array(
            'base_url' => $credentials['baseUrl'],
            'format' => $credentials['format'],
            'headers' => $this->buildHeaders($credentials)
        ));

        $result = $api->$queryType($entity->getComponentName()."/$verb/", $params);
        if($result->info->http_code == 200){
            $decodedResult = $result->decode_response();
            if(is_null($decodedResult)) {
                return null;
            }
            if(array_key_exists('code', $decodedResult)) {
                $this->handleError($decodedResult);
            }
            //reset the XSS token for next request
            if(isset($decodedResult->AuthorizationToken)) {
                $_SESSION['AuthorizationToken'] = $decodedResult->AuthorizationToken;
            }

            return($decodedResult);
        }elseif($result->info->http_code == 500){

            $decodedResult = $result->decode_response();

            if(array_key_exists('code', $decodedResult)) {
                $this->handleError($decodedResult);
            }
        }
    }

    private function handleError(\stdClass $result) {

        if($result->code == 1012) {
            //Parameter was missing - perhaps we simply need to force a new login to jiggle the handle
            header('location: /login');
            die();
        }
    }

    private function buildHeaders($credentials) {

        $retval = array(
                'serverAuth'=>$credentials['headers']['serverAuth']
                );
        if(isset($_SESSION['AuthorizationToken'])) {
            $retval['Authorization'] = $_SESSION['AuthorizationToken'];
        }
        if(isset($_SESSION['User'])) {
            $retval['userId'] = $_SESSION['User']->id;
        }
        if(isset($_SESSION['Customer_id'])) {
            $retval['Customer_id'] = $_SESSION['Customer_id'];
        }

        return $retval;
    }
    
    private function getCredentials($ymlKey) {

        $config = new YAMLCredentialsConfiguration($this->logger);
        
        $credentials = $config->getNodeParameters($ymlKey);
       
        unset($config);
        return $credentials;
    }
}
