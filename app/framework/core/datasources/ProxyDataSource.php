<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/9/2016
 * Time: 4:00 PM
 */

namespace core\datasources;


use core\ProxyRestClient;
use core\AbstractModel;

class ProxyDataSource extends RestDataSource
{

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
    public function query($queryType, AbstractModel $entity, $uri, $params) {
        $ymlKey = $this->keyname;

        $configParams = $this->getCredentials($ymlKey);
        $credentials = $configParams['credentials'];

        $api = new ProxyRestClient(array(
            'base_url' => $credentials['baseUrl'],
            'format' => $credentials['format'],
            'headers' => $this->buildHeaders($credentials)
        ));
        $api->setLogger($this->logger);

        $result = $api->$queryType($uri, $params);
         // pr($result);

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
    
}