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
class PurchaseOrderModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'PurchaseOrder';
        $this->tablename = 'purchaseorders';
    }

    public function getFormWrapper() {
        return $this->entity;
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
        
        return $data;
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
        $params['PurchaseOrder']['createStaff_id'] = $this->getLoggedInStaffId();
        $params[$this->entity]['id'] = intval($id);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);

        return $data;
    }
}
