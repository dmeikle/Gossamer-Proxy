<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\pdfs\controllers;

use core\AbstractController;

/**
 * Description of PdfsController
 *
 * @author Dave Meikle
 */
class PdfsController extends AbstractController {

    public function getWorkAuth($claimId, $claimLocationId = null) {
        $locale = $this->getDefaultLocale();

        $params = array('pdfName' => 'workauth', 'Claims_id' => intval($claimId), 'locale' => $locale['locale']);

        if (!is_null($claimLocationId)) {
            $params['ClaimsLocations_id'] = intval($claimLocationId);
        }

        $data = $this->model->getPdf($params);
        $data['filename'] = 'work-authorization.pdf';

        $this->render($data);
    }

}
