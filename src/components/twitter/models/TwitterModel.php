<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\twitter\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use TwitterAPIExchange;

/**
 * TicketModel
 *
 * @author Dave Meikle
 */
class TwitterModel extends AbstractModel {
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Twitter';
        $this->tablename = 'twitter';        
    }    

    public function getTraffic($numRows) {
        
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=am730traffic&count=' . $numRows;
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->getCredentials());


        $string = json_decode($twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc = TRUE);    

        if(array_key_exists('errors', $string) && $string["errors"][0]["message"] != "") {
            echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
            exit();

        }
        
        return $string;
    }
    
    private function getCredentials() {
        $loader = new \libraries\utils\YAMLParser($this->logger);
        $loader->setFilePath(__CONFIG_PATH . '\config.yml');
        
        $config = $loader->loadConfig();
        if(!array_key_exists('twitter', $config)) {
            throw new \exceptions\KeyNotSetException('twitter key missing from config');
        }
        
        return $config['twitter'];
        
    }
}
