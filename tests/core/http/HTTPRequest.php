<?php

namespace tests\core\http;

use core\http\HTTPRequest as CoreRequest;


/**
 * Description of HttpRequest
 *
 * @author davem
 */
class HTTPRequest extends CoreRequest{
   
    protected $SERVER = array();
    
    public function __construct($requestUri, $httpReferer, $queryString = '', $post = array(), $requestParameters = null, $pattern = '') {

       $this->SERVER['HTTP_REFERER'] = $httpReferer;
       $this->SERVER['QUERY_STRING'] = $queryString; 
            
       $filter = $this->parseURIParams($pattern);
       $this->postParameters = $post;
       $this->formatQueryString();
       $params = $this->getParams($filter, $requestUri);   
       
       $this->setAttribute('HTTP_REFERER', $httpReferer);       
       
       $this->uri = $requestUri;
       $this->requestParameters = $params;
    }
    
    protected function formatQueryString() {
        $temp = explode('&', $this->SERVER['QUERY_STRING']);
        foreach($temp as $row) {
            $pieces = explode('=', $row);
            $pieces = array_filter($pieces);
            if(is_array($pieces) && count($pieces) > 0) {
                $this->queryString[$pieces[0]] = $pieces[1];
            }
            
        }
    }
    
    
}
