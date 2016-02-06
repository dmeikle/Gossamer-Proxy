<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\compression\traits;

trait KeyTrait {

    protected function getKey($params = null) {
        $filename = '';
        $fileList = explode(',', $this->httpRequest->getQueryParameter('files'));
        $type = $this->getType($fileList[0]);
        foreach ($fileList as $file) {

            $pieces = explode('/', $file);
            $name = array_pop($pieces);
            $filename .= '_' . str_replace($type, '', $name);
        }

        return md5($type . str_replace('.', '-', $filename));
    }

    private function getType($fileList) {
        $type = substr($fileList, strlen($fileList) - 4);
        if ($type == '.css') {
            return 'css';
        } elseif (substr($type, 1) == '.js') {
            return 'js';
        }

        return null;
    }

}
