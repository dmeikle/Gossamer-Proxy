<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\caching\eventlisteners;

use core\eventlisteners\Event;

/**
 * ReplaceParamsInCacheListener
 *
 * @author Dave Meikle
 */
class ReplaceParamsInHTMLListener extends \core\eventlisteners\AbstractListener {

    public function on_render_complete(Event &$event) {
        $this->replaceObjectParams($event);
        $this->replaceVariableParams($event);
    }

    public function on_render_bypass(Event &$event) {
        $this->replaceObjectParams($event);
        $this->replaceVariableParams($event);
    }

    private function replaceObjectParams(Event &$event) {
        $params = $event->getParams();

        $matches = $this->getObjectURITagKeys($params['renderedPage']);
        $list = $this->combineArrays($matches);

        $params['renderedPage'] = $this->embedObjectParams($list, $params['renderedPage']);

        $event->setParams($params);
    }

    private function replaceVariableParams(Event $event) {
        $params = $event->getParams();

        $matches = $this->getVariableURITagKeys($params['renderedPage']);

        $params['renderedPage'] = $this->embedVariableParams(array_unique($matches), $params['renderedPage']);

        $event->setParams($params);
    }

    private function embedVariableParams(array $list, $html) {

        foreach ($list as $fieldName) {

            $value = $this->httpRequest->getAttribute($fieldName);

            $html = str_replace("gcms=\"{param='$fieldName'}\"", "value=\"$value\"", $html);
        }

        return $html;
    }

    private function embedObjectParams(array $list, $html) {

        foreach ($list as $className => $item) {
            $class = $this->httpRequest->getAttribute($className);

            foreach ($item as $fieldName) {
                $value = $class[$fieldName];
                $html = str_replace("gcms=\"{object='$className' param='$fieldName'}\"", "value=\"$value\"", $html);
            }
        }

        return $html;
    }

    private function combineArrays(array $matches) {
        $retval = array();
        $keys = $matches[0];
        $fields = $matches[1];
        for ($i = 0; $i < count($keys); $i++) {
            $retval[$keys[$i]][] = $fields[$i];
        }

        return $retval;
    }

    protected function getObjectURITagKeys($html) {

        $pattern = "/gcms=\"{object='(.*?)' param='(.*?)'}\"/";

        preg_match_all($pattern, $html, $matches);
        array_shift($matches);

        return $matches;
    }

    protected function getVariableURITagKeys($html) {

        $pattern = "/gcms=\"{param='(.*?)'}\"/";

        preg_match_all($pattern, $html, $matches);

        array_shift($matches);
        if (count($matches) > 0) {
            $matches = current($matches);
        }
        return $matches;
    }

}
