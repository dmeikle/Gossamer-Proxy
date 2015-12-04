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

/**
 * LoadFileCountsListener
 *
 * @author Dave Meikle
 */
class LoadFileCountsListener extends \core\eventlisteners\AbstractListener {

    public function on_filerender_start($params) {

        $path = __UPLOADED_FILES_PATH . 'claims' . DIRECTORY_SEPARATOR . $this->getClaimId();
        echo $path . "\r\n";
        $folders = $this->folderlist($path);

        $total_files = 0;
        foreach ($folders as $folder) {
            $path = $folder['path'];
            $name = $folder['name'];
            echo "path: $path\r\nname: $name \r\n\r\n";
            $count = iterator_count(new \DirectoryIterator($path . $name));
            $total_files += $count;

            echo '<li>';
            echo '<a href="' . $path . 'index.php?album=' . $name . '" class="style1">';
            echo '<strong>' . $name . '</strong>';
            echo ' (' . $count . ' files found)';
            echo '</a>';
            echo '</li>';
        }
    }

    private function getClaimId() {
        $param = $this->httpRequest->getParameter('Claims_id');

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
                        if (filetype($startdir . $folder) == "dir") {
                            $directorylist[$startdir . $folder]['name'] = $folder;
                            $directorylist[$startdir . $folder]['path'] = $startdir;
                        }
                    }
                }
                closedir($dh);
            }
        }
        return($directorylist);
    }

}
