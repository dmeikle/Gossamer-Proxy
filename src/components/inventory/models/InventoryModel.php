<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of DepartmentModel
 *
 * @author Dave Meikle
 */
class InventoryModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Inventory';
        $this->tablename = 'inventory';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function search($offset, $limit, array $params) {
        $params['directive::OFFSET'] = intval($offset);
        $params['directive::LIMIT'] = intval($limit);

        $data = $this->dataSource->query(self::VERB_GET, $this, 'search', $params);

        return $data;
    }

}
