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
use core\UploadableInterface;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of AccountingVendorInvoiceModel
 *
 * @author Dave Meikle
 */
class AccountingVendorInvoiceModel extends AbstractModel implements UploadableInterface, FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'VendorInvoice';
        $this->tablename = 'accountingvendorinvoices';
    }

    public function getUploadPath() {
        return __UPLOADED_FILES_PATH . 'invoices';
    }

    public function saveParamsOnComplete(array $params) {
        $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
    }

    public function getFormWrapper() {

    }

}
