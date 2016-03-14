<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\views;

use core\AbstractView;

/**
 * Used as the view for all Ajax requests that need the response header
 * to be application/json and without rendering any other calls.
 *
 * @author Dave Meikle
 */
class AJAXExceptionView extends AbstractView {

    //need this to override the default destruct in parent class
    // DO NOT REMOVE
    public function __destruct() {

    }

    protected function renderView() {

        header('Content-Type: application/json');

        if (!is_null($this->data)) {
            try {
                //we don't want this in our json
                unset($this->data['SystemLocalesList']);
                unset($this->data['NAVIGATION']);
                unset($this->data['locales']);
                // The second parameter of json_decode forces parsing into an associative array
                //extract(json_decode(json_encode($this->data), true));
                echo json_encode(array('result' => 'error', 'data' => $this->data));
            } catch (\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }
    }

}
