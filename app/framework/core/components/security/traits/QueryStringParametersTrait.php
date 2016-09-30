<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/10/2016
 * Time: 3:26 PM
 */

namespace core\components\security\traits;


trait QueryStringParametersTrait
{

    protected function getQueryStringParameter($key) {
        $querystring = str_replace('?', '', $_SERVER['QUERY_STRING']);

        parse_str($querystring, $params);

        if(array_key_exists($key, $params)) {
            return $params[$key];
        }

        return null;
    }
}