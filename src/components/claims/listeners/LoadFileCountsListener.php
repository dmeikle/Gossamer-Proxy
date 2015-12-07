<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;

use components\claims\models\ClaimModel;

/**
 * LoadFileCountsListener
 *
 * @author Dave Meikle
 */
class LoadFileCountsListener extends \core\eventlisteners\AbstractListener {

    public function on_filerender_start($params) {

        $path = __UPLOADED_FILES_PATH . 'claims' . DIRECTORY_SEPARATOR . $this->getClaimId();
        $locations = $this->getClaimLocations();

        $folders = $this->folderlist($path);

        $folderList = array();
        $totalFiles = 0;
        foreach ($folders as $claimLocation => $folder) {
            $path = $folder['path'] . DIRECTORY_SEPARATOR;
            //$folderList[] = $folder['name'];
            //$this->mergeFilepaths($folder, $folders, $folderList);
            $count = iterator_count(new \DirectoryIterator($path . $claimLocation));
            $totalFiles += $count;
            $folderList[$claimLocation]['count'] = $count;
            if (array_key_exists($claimLocation, $locations)) {
                $folderList[$claimLocation]['unitNumber'] = $locations[$claimLocation];
            } else {
                $folderList[$claimLocation]['unitNumber'] = '0';
            }
        }
        $folderList['totalFiles'] = $totalFiles;

        $this->httpRequest->setAttribute('folderList', $folderList);
    }

    private function getClaimLocations() {

        $datasource = $this->getDatasource('components\\claims\\models\\ClaimModel');
        $model = new ClaimModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = array('Claims_id' => $this->getClaimId());

        return $this->formatUnitNumbers($datasource->query('get', $model, 'getunitnumbers', $params));
    }

    private function getClaimId() {
        $param = $this->httpRequest->getQueryParameter('Claims_id');

        return $param;
    }

    private function folderlist($path) {
        $directorylist = array();
        $startdir = $path;
        $ignoredDirectory[] = '.';
        $ignoredDirectory[] = '..';
        if (is_dir($startdir)) {
            if ($dh = opendir($startdir)) {
                while (($folder = readdir($dh)) !== false) {
                    if (!(array_search($folder, $ignoredDirectory) > -1)) {
                        if (filetype($startdir . DIRECTORY_SEPARATOR . $folder) == "dir") {
                            $directorylist[$folder]['id'] = $folder;
                            $directorylist[$folder]['path'] = $startdir;
                        }
                    }
                }
                closedir($dh);
            }
        }

        return ($directorylist);
    }

    private function formatUnitNumbers(array $units) {
        $retval = array();
        foreach ($units['unitNumbers'] as $unit) {
            $retval[$unit['id']] = $unit['unitNumber'];
        }
        return $retval;
    }

}
