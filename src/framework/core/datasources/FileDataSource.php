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
        $this->downloadFile();
        return;
//        return $this->$verb($params['content'], $params['filepath']);
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
        $this->downloadFile();
        //return array('payload' => file_get_contents($filepath));
    }

    private function downloadFile() {

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $url = "http://www.offthemaptattoo.com/The-Perfect-Tattoo.pdf";
//        file_put_contents("/var/www/ip2/phoenixrestorations.com/logs/save.log", fopen($url, 'r'));
//        die('complete');
//        
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $r = curl_exec($ch);
        curl_close($ch);
        header('Expires: 0'); // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Cache-Control: private', false);
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="' . basename($url) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($r)); // provide file size
        header('Connection: close');
        echo $r;
//        set_time_limit(0);
//
//        //File to save the contents to
//        $fp = fopen('/var/www/ip2/phoenixrestorations.com/logs/save.log', 'w+');
//
//        //
//        $url = 'http://www.quantumunit.com/';
//        //Here is the file we are downloading, replace spaces with %20
//        $ch = curl_init(str_replace(" ", "%20", $url));
//
//        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
//
//        //give curl the file pointer so that it can write to it
//        curl_setopt($ch, CURLOPT_FILE, $fp);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//
//        $data = curl_exec($ch); //get curl response
//        pr($data);
//        //done
//        curl_close($ch);
//
//        $ch = curl_init();
//        $timeout = 5;
//        //$userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US)AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.X.Y.Z Safari/525.13.";
//        $userAgent = "IE 7 – Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)";
//        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
//        curl_setopt($ch, CURLOPT_FAILONERROR, true);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//        curl_setopt($ch, CURLOPT_FILE, $fp);
//        $data = curl_exec($ch);
//        curl_close($ch);
//        echo "<hr>";
//        pr($data);
//        echo "<hr>";
    }

}
