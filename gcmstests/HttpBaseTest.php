<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

/** *
 * Author: dave
 * Date: 9/18/2016
 * Time: 3:50 PM
 */

namespace gcmstests;


class HttpBaseTest extends BaseTest
{

    protected function getBaseUrl() {
        global $BASE_URL;
        if(!isset($BASE_URL)) {
            throw new \Exception('--bootstrap <filepath> not specified in phpunit CLI request - need $BASE_URL parameter');
        }

        return $BASE_URL;
    }

    protected function get($uri, array $params = array())
    {
        if (count($params) > 0) {
            $uri .= '?' . \http_build_query($params);
        }
   
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'PHP Unit Test'
        ));
        // Send the request & save response to $resp
        $response = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        return json_decode($response, true);
    }

    protected function post($url, array $data = array())
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);


    }
}

// non-curl method:
//
//$url = 'http://server.com/path';
//$data = array('key1' => 'value1', 'key2' => 'value2');
//
//// use key 'http' even if you send the request to https://...
//$options = array(
//    'http' => array(
//        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//        'method'  => 'POST',
//        'content' => http_build_query($data)
//    )
//);
//$context  = stream_context_create($options);
//$result = file_get_contents($url, false, $context);
//if ($result === FALSE) { /* Handle error */ }
//
//var_dump($result);