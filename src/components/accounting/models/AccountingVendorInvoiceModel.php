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
        return $this->entity;
    }

    /**
     * performs a save to the datasource
     *
     * @param int $id
     *
     * @return type
     */
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
//        pr($params);
//        die();
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
//        pr($data);
        return $data;
    }

    /**
     * retrieves a row from the datasource for editing
     *
     * @param int $id
     *
     * @return array
     */
    public function edit($id) {

        $locale = $this->getDefaultLocale();

        if ($this->isFailedValidationAttempt()) {

            return $this->httpRequest->getAttribute('POSTED_PARAMS');
        }

        $params = array(
            'id' => intval($id),
            'locale' => $locale['locale']
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

//        if (is_array($data) && array_key_exists($this->entity, $data)) {
//            $data = current($data[$this->entity]);
//        }

        return $data;
    }

}
