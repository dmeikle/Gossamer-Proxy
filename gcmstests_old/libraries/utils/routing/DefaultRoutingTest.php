<?php

namespace tests\libraries\utils\routing;

use libraries\utils\routing\DefaultRouting;
use tests\core\http\HTTPRequest;

/**
 * Description of DefaultRoutingTest
 *
 * @author Dave Meikle
 */
class DefaultRoutingTest extends \tests\BaseTest {
    
    
    public function testGetDefaultRouting() {
        $requestUri = 'restoration/content-restoration-services';
        $httpReferer = 'some-other-url';
        $queryString = '';
        $post = array();
        
        $httpRequest = new HTTPRequest($requestUri, $httpReferer, $queryString, $post);
        $routing = new DefaultRouting($httpRequest);
        
        $key = $routing->getDefaultRoutingKey($this->getConfig());
        
        $this->assertEquals($key, 'cms_view_page_1');
    }
    
    public function testGetDefaultRoutingWildCard() {
        $requestUri = 'unrelated/content-restoration-services';
        $httpReferer = 'some-other-url';
        $queryString = '';
        $post = array();
        
        $httpRequest = new HTTPRequest($requestUri, $httpReferer, $queryString, $post);
        $routing = new DefaultRouting($httpRequest);
        
        $key = $routing->getDefaultRoutingKey($this->getConfig());
        
        $this->assertEquals($key, 'cms_view_page_4');
    }
    
    public function testGetDefaultRoutingBadUrl() {
        $requestUri = '';
        $httpReferer = 'some-other-url';
        $queryString = '';
        $post = array();
        
        $httpRequest = new HTTPRequest($requestUri, $httpReferer, $queryString, $post);
        $routing = new DefaultRouting($httpRequest);
        
        $key = $routing->getDefaultRoutingKey($this->getConfig());
        
        $this->assertFalse($key);
    }
    
    private function getConfig() {
        return array(
            'cms_view_page_1' =>
                array(
                    'pattern' => 'restoration/*'
                ),
            'cms_view_page_2' =>
                array(
                    'pattern' => 'restoration/*/*'
                ),
            'cms_view_page_3' =>
                array(
                    'pattern' => 'restoration/*/*/*'
                ),
            'cms_view_page_4' =>
                array(
                    'pattern' => '*/*'
                )
            );
    }
}