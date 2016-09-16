<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/9/2016
 * Time: 2:01 PM
 */

namespace libraries\tests\utils;

error_reporting(E_ALL);
ini_set('display_errors', 1);
use libraries\utils\YAMLConfiguration;
use libraries\utils\YAMLParser;

class YamlConfigurationTest extends \gcmstests\BaseTest
{

    public function testFindTrailingWildCard() {
        define('__REQUEST_METHOD', 'GET');

        $ymlConfiguration = new YAMLConfiguration($this->getLogger());

        $uri = '/members/0/20';
        $config = $this->loadConfig();

        $result = $ymlConfiguration->findConfigKeyByURIPattern($config,$uri);

        $this->assertEquals($result, 'members_list');
    }


    public function testFindMiddleWildcard() {

        $ymlConfiguration = new YAMLConfiguration($this->getLogger());

        $uri = '/members/K00001/reports';
        $config = $this->loadConfig();

        $result = $ymlConfiguration->findConfigKeyByURIPattern($config,$uri);

        $this->assertEquals($result, 'members_report_get');
    }



    public function testFindMiddleWildcard2() {

        $ymlConfiguration = new YAMLConfiguration($this->getLogger());

        $uri = '/members/K00001/phpunit';
        $config = $this->loadConfig();

        $result = $ymlConfiguration->findConfigKeyByURIPattern($config,$uri);

        $this->assertEquals($result, 'members_phpunit');
    }

    private function loadConfig() {
        $loader = new YAMLParser($this->getLogger());
        $loader->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'libraries'
            . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.yml');

        return $loader->loadConfig();
    }
}