<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\callmatrix\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class OnCallInstanceModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'OnCallInstance';
        $this->tablename = 'oncallinstances';
    }

    public function search() {
        $params = array('keywords' => $this->httpRequest->getPost());

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']);

        return $this->formatResults($data['Claims']);
    }

    private function formatResults(array $results) {
        $retval = array();

        foreach ($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['buildingName'] . "," . $row['address1'] . ", " . $row['address2'] . ", " .
                $row['city'],
                'value' => '<b>' . $row['buildingName'] . "</b><br />" . $row['address1'] . "<br />" .
                ((strlen($row['address2']) > 0) ? $row['address2'] . '<br />' : '') .
                $row['city']
            );
        }

        return $retval;
    }

    public function get($id) {
        return array();
    }

    public function listByDate($year, $month) {

        $params = array('onCallDate' => $year . $month);
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByDate', $params);

        return array('OnCallInstances' => $this->formatDateResults($data['OnCallInstances']));
    }

    private function formatDateResults(array $list) {
        $retval = array();
        foreach ($list as $row) {

            $date = substr($row['onCallDate'], 0, 10);
            $retval[$date][] = $row;
        }

        return $retval;
    }

    public function showCalendar($year, $month) {
        return array();
    }

    public function showAddStaff($year, $month) {
        return array();
    }

}
