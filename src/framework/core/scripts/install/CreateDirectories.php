<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\scripts\install;

use Composer\Script\Event;

/**
 * CreateDirectories
 *
 * @author Dave Meikle
 */
class CreateDirectories {

    public static function postInstall(Event $event) {
        $installedPackage = $event->getOperation()->getPackage();

        $rootPath = $this->getRootPath();

        //first create the log folder
        $this->createWritableFolder($rootPath, 'app/logs');

        //next create the cache folder
        $this->createWritableFolder($rootPath, 'app/cache');

        //now create the writable folders for css
        $this->createWritableFolder($rootPath, 'web/css/components');

        //now create the writable folders for js
        $this->createWritableFolder($rootPath, 'web/js/components');
    }

    private function createWritableFolder($rootPath, $pathFromRoot) {
        if (!file_exists($rootPath . DIRECTORY_SEPARATOR . $pathFromRoot)) {
            mkdir($rootPath . DIRECTORY_SEPARATOR . $pathFromRoot);
        }

        chmod($rootPath . DIRECTORY_SEPARATOR . $pathFromRoot, '0777');
    }

    private function getRootPath() {
        $cwd = getcwd();

        $pieces = explode('/', $cwd);
        //move to root directory
        for ($i = 0; $i < 5; $i++) {
            array_pop($pieces);
        }

        return implode('/', $pieces);
    }

}
