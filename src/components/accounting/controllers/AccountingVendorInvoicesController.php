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

}
