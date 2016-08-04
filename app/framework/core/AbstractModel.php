<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core;

use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\datasources\DataSourceInterface;
use libraries\utils\Container;
use libraries\utils\Pagination;
use Gossamer\Caching\CacheManager;
use core\components\mappings\models\MappingModel;
use libraries\utils\preferences\UserPreferencesManager;
use libraries\utils\preferences\UserPreferences;

/**
 * abstract base class for models
 *
 * @author Dave Meikle
 */
class AbstractModel {

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
    const VERB_SEARCH = 'search';
    const VERB_SAVE = 'save';
    const DIRECTIVES = 'directives';

    protected $entity;
    protected $childNamespace;
    protected $tablename;

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest &$httpRequest, HTTPResponse &$httpResponse = null, Logger $logger) {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->logger = $logger;
        $this->entity = get_called_class();
    }


    /**
     * accessor
     *
     * @return string
     */
    public function getComponentName() {
        $pieces = explode(DIRECTORY_SEPARATOR, $this->childNamespace);
        array_pop($pieces);

        return array_pop($pieces);
    }

    /**
     * accessor
     *
     * @return string
     */
    function getTablename() {
        return $this->tablename;
    }

    /**
     * accessor
     *
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;
    }

    /**
     *
     * @param type $stripNamespace
     *
     * @return string
     */
    public function getEntity($stripNamespace = false) {
        if ($stripNamespace) {
            $pieces = explode('\\', $this->entity);

            return array_pop($pieces);
        }
        return $this->entity;
    }

    /**
     * accessor
     *
     * @param DataSourceInterface $dataSource
     */
    public function setDataSource(DataSourceInterface $dataSource) {
        $this->dataSource = $dataSource;
    }

    
    /**
     * queries the datasource and deletes the record
     *
     * @param type $offset
     * @param type $rows
     *
     * @return array
     */
    public function delete($customVerb = null) {

        return $this->dataSource->query(self::METHOD_DELETE, $this, (is_null($customVerb) ? self::VERB_DELETE : $customVerb), $params);
    }


    /**
     * performs a save to the datasource
     *
     * @param int $id
     *
     * @return type
     */
    public function save(array $params, $customVerb = null) {

        return $this->dataSource->query(self::METHOD_POST, $this, (is_null($customVerb) ? self::VERB_SAVE : $customVerb), $params);
    }



    /**
     * queries the database with custom passed in params and returns the result
     *
     * @param int $offset
     * @param int $rows
     * @param array $params
     * @param string $customVerb
     *
     * @return array
     */
    public function listall(array $params, $customVerb = null) {

        return $this->dataSource->query(self::METHOD_GET, $this, (is_null($customVerb) ? self::VERB_LIST : $customVerb), $params);
    }


    /**
     * retrieves a row from the datasource for editing
     *
     * @param int $id
     *
     * @return array
     */
    public function get(array $params) {

        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    }


    /**
     * accessor
     *
     * @return HttpRequest
     */
    public function getHttpRequest() {
        return $this->httpRequest;
    }

    /**
     * accessor
     *
     * @return HttpResponse
     */
    public function getHttpResponse() {
        return $this->httpResponse;
    }



}
