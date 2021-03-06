<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\handlers;

use core\handlers\URITagHandler as BaseHandler;
use core\components\render\system\RenderRouter;

/**
 * URITagHandler
 *
 * @author Dave Meikle
 */
class URITagHandler extends BaseHandler {

    /**
     *
     * @return array
     */
    protected function getURITagKeys() {
        //<gmcs:uri=cart_admin_categories_list/>
        //$pattern = "/<gcms:uri='(.*?)'(.*?)\/>/";
        $pattern = "/gcms=\"{uri='(.*?)'(.*?)}\"/";

        preg_match_all($pattern, $this->template, $matches);

        array_shift($matches);

        return $matches;
    }

    protected function buildLinks($tags) {
        $router = new RenderRouter($this->logger, $this->httpRequest);
        $links = $tags[0];
        $params = $tags[1];
        $linkList = array();
        $retval = array();
        for ($i = 0; $i < count($links); $i++) {
            $linkParams = $this->formatParams($params[$i]);
            $key = "gcms=\"{uri='" . $links[$i] . ((count($linkParams) > 0) ? "'" . $params[$i] : "'") . '}"';

            $retval[$key] = $router->getQualifiedUrl($links[$i], $linkParams);
            //$router->getQualifiedUrl($links[$i], $linkParams);
        }

        return $retval;
    }

}
