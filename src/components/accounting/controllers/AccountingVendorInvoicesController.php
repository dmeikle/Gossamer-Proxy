<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\controllers;

use core\AbstractController;

/**
 * Description of AccountingVendorInvoices
 *
 * @author Dave Meikle
 */
class AccountingVendorInvoicesController extends AbstractController {

    public function search() {

        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }

    public function download($id) {
        $invoice = $this->model->edit(intval($id));
        if (!array_key_exists('VendorInvoice', $invoice)) {
            throw new \Exception('Invoice not found');
        }
        $params = array(
            'module' => 'invoices',
            'filename' => $invoice['VendorInvoice'][0]['filename']
        );

        $this->render($params);
    }

}
