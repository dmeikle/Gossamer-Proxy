<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\widgets\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * SystemWidget
 *
 * @author Dave Meikle
 */
class WidgetPageWidgetModel extends AbstractModel {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'WidgetPageWidget';
        $this->tablename = 'widgetpagewidgets';
    }

    public function listallByPage($pageId) {
        $params = array('pageId' => $pageId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return $data;
    }

    /**
     * queries the datasource and deletes the record
     *
     * @param type $offset
     * @param type $rows
     *
     * @return array
     */
    public function deletePageWidget($ymlKey, $widgetId) {
        $params = array(
            'Widgets_id' => intval($widgetId),
            'ymlKey' => $ymlKey
        );


        return $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
    }

}
