<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\companies\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of CompanyModel
 *
 * @author Dave Meikle
 */
class CompanyModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Company';
        $this->tablename = 'companies';
    }

    private function formatResults(array $results) {
        $retval = array();
        foreach ($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['name'] . "," . $row['address1'] . ", " . $row['address2'] . ", " .
                $row['city'],
                'value' => '<b>' . $row['name'] . "</b><br />" . $row['address1'] . "<br />" .
                ((strlen($row['address2']) > 0) ? $row['address2'] . '<br />' : '') .
                $row['city']
            );
        }

        return $retval;
    }

    public function searchResults() {
        return array();
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function paginate($offset, $limit) {
        $params = array(
            'directive::OFFSET' => intval($offset),
            'directive::LIMIT' => $intval($limit),
            'isActive' => '1'
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'count', $params);
        pr($data);
        die;
    }

    public function search(array $params) {
        $offset = 0;
        $rows = 20;

        $params = array_merge($params, array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        ));
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params);


        if (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }

        return $data;
    }

}
