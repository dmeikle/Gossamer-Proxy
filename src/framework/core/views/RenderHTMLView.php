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
class RenderHTMLView extends AbstractView {
    //need this to override the default destruct in parent class
    // DO NOT REMOVE
//    public function __destruct() {
//
//    }

    /**
     * renderView - pass in preloaded HTML template in the data array
     * and this will render any tags within before sending out
     *
     * requires key 'html' in the data array
     */
    protected function renderView() {

        // header('Content-Type: application/json');

        if (!is_null($this->getData())) {

            try {
                $config = $this->getData();
                $this->template = $config['html'];
            } catch (\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }
    }

    public function getValue($key) {
        return $this->httpRequest->getAttribute($key);
    }

}
