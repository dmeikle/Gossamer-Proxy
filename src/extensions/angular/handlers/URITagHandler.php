<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\angular\handlers;

use core\handlers\URITagHandler as BaseHandler;
use extensions\angular\system\AngularRouter;

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
        $router = new AngularRouter($this->logger, $this->httpRequest);
        $links = $tags[0];
        $params = $tags[1];
        $linkList = array();
        $retval = array();
        for ($i = 0; $i < count($links); $i++) {
            $linkParams = $this->formatParams($params[$i]);
            $key = "gcms=\"{uri='" . $links[$i] . ((count($linkParams) > 0) ? "'" . $params[$i] : "'") . '}"';
            try {
                $retval[$key] = $router->getQualifiedUrl($links[$i], $linkParams);
            } catch (\Exception $e) {
                throw new Exception('unable to locate ' . $links[$i] . ' while rendering Angular URI Tag');
            }
            //$router->getQualifiedUrl($links[$i], $linkParams);
        }

        return $retval;
    }

}
