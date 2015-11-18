<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of PurchaseOrderModel
 *
 * @author Dave Meikle
 */
class AccountingCashReceiptModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'AccountingCashReceipt';
        $this->tablename = 'accountingcashreceipts';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    /**
     *
     * @param type $offset
     * @param type $rows
     * @param type $customVerb
     * @return type
     */
    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {
        //if (is_null($params)) {
        $params = $this->httpRequest->getQueryParameters();
        //}
        return $this->listallWithParams($offset, $rows, $params, $customVerb);
    }

}
