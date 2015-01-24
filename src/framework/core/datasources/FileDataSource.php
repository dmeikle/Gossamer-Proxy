<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

use core\datasources\DataSourceInterface;
use core\AbstractModel;

/**
 * used for reading/writing info to a file datasource
 * 
 * @author Dave Meikle
 */
class FileDataSource implements DataSourceInterface {

    private $keyname;

    /**
     * query    - a few of the default parameters passed in will not be used for
     *            the basic simplicity of the File I/O
     * 
     * @param string queryType  PUT/POST/GET/DELETE #ignored
     * @param AbstractModel entity  #ignored
     * @param string verb       save/delete/get/list #required
     * @param array params      parameters needed for file I/O
     */
    public function query($queryType, AbstractModel $entity, $verb, $params) {

        return $this->$verb($params['content'], $params['filepath']);
    }

    /**
     * 
     * @param string $keyName
     */
    public function setDatasourceKey($keyName) {
        $this->keyname = $keyName;
    }

    private function save($content, $filepath) {
        file_put_contents($filepath, $content);
    }

    private function delete($content, $filepath) {
        shell_exec('rm -fr ' . $filepath);
    }

    private function get($content, $filepath) {
        return array('payload' => file_get_contents($filepath));
    }

}
