<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

use core\datasources\DataSourceInterface;
use core\RestClient;
use libraries\utils\YAMLCredentialsConfiguration;
use Monolog\Logger;
use core\AbstractModel;
use core\datasources\AdapterInterface;

/**
 * Datasource used to connect to the RESTful API server
 *
 * @author Dave Meikle
 */
class RestDataSource implements DataSourceInterface, AdapterInterface {

    protected $logger = null;
    protected $keyname = null;

    const METHOD_DELETE = 'delete';
    const METHOD_SAVE = 'save';
    const METHOD_PUT = 'put';
    const METHOD_POST = 'post';
    const METHOD_GET = 'get';
    const VERB_LIST = 'list';
    const VERB_DELETE = 'delete';
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
        $api->setLogger($this->logger);

        $result = $api->$queryType($entity->getTablename() . "/$verb/", $params);

      //  pr($result);

        if ($result->info->http_code == 200) {
            $decodedResult = $result->decode_response();

            if (is_null($decodedResult) || empty($decodedResult)) {
                return null;
            }
            if (array_key_exists('code', $decodedResult)) {
                $this->handleError($decodedResult);
            }
            //reset the XSS token for next request
            if (isset($decodedResult->AuthorizationToken)) {
                $_SESSION['AuthorizationToken'] = $decodedResult->AuthorizationToken;
            }

            return($decodedResult);
        } elseif ($result->info->http_code == 500) {

            $decodedResult = $result->decode_response();

            if (array_key_exists('code', $decodedResult)) {
                $this->handleError($decodedResult);
            }
        }
    }

    protected function handleError($result) {
die('here');
        if (!is_object($result)) {
            echo json_encode($result);
            die;
        }
        if ($result->code == 1012) {
            //Parameter was missing - perhaps we simply need to force a new login to jiggle the handle
            header('location: /login');
            die();
        }
    }

    /**
     * builds the headers for the request
     *
     * @param type $credentials
     *
     * @return array
     */
    protected function buildHeaders($credentials) {

        $retval = $credentials['headers'];

        if (isset($_SESSION['AuthorizationToken'])) {
            $retval['Authorization'] = $_SESSION['AuthorizationToken'];
        }
        if (isset($_SESSION['User'])) {
            $retval['userId'] = $_SESSION['User']->id;
        }
        if (isset($_SESSION['Customer_id'])) {
            $retval['Customer_id'] = $_SESSION['Customer_id'];
        }

        return $retval;
    }

    /**
     * gets the credentials to identify ourselves to the API server
     *
     * @param type $ymlKey
     *
     * @return array
     */
    protected function getCredentials($ymlKey) {

        $config = new YAMLCredentialsConfiguration($this->logger);

        $credentials = $config->getNodeParameters($ymlKey);
        unset($config);

        return $credentials;
    }

}
