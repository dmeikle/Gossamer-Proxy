<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\compression\views;

use core\AbstractView;
use core\eventlisteners\Event;

/**
 * ResourceFileView
 *
 * @author Dave Meikle
 */
class ResourceFileView extends AbstractView {

    use \core\components\compression\traits\KeyTrait;

    /**
     * to be called in child class
     */
    protected function renderView() {


        // Send Content-Type
        header("Content-Type: text/" . $this->data['type']);
        // Send Etag hash
        $this->setEtag($this->getKey());

        if (isset($encoding) && $encoding != 'none') {
            // Send compressed contents
            $contents = gzencode($contents, 9, $gzip ? FORCE_GZIP : FORCE_DEFLATE);
            header("Content-Encoding: " . $encoding);
            header('Content-Length: ' . strlen($this->data['contents']));
            echo $this->data['contents'];
        } else {
            // Send regular contents
            header('Content-Length: ' . strlen($this->data['contents']));
            echo $this->data['contents'];
        }

        $event = new Event('render_complete', $this->data);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'render_complete', $event);
    }

    //need this to override the default destruct in parent class
    public function __destruct() {

    }

    protected function setEtag($key) {
        $date = getdate();

        header("Etag: \"" . $date['month'] . $date['mday'] . $date['year'] . '-' . md5($key) . "\"");
    }

}
