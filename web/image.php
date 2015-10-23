<?php

$filepath = '/var/www/phoenix-portal/htdocs/web/images/';
$imagePath = sanitizeFilename($_GET['imagepath']);

serveImage($filepath . $imagePath);

function serveImage($filepath) {

    if (file_exists($filepath)) {

        $path_parts = pathinfo($filepath);
        switch (strtolower($path_parts['extension'])) {
            case "gif":
                header("Content-type: image/gif");
                break;
            case "jpg":
            case "jpeg":
                header("Content-type: image/jpeg");
                break;
            case "png":
                header("Content-type: image/png");
                break;
            case "bmp":
                header("Content-type: image/bmp");
                break;
        }

        header("Accept-Ranges: bytes");
        header('Content-Length: ' . filesize($filepath));
        header("Last-Modified: Fri, 03 Mar 2004 06:32:31 GMT");
        readfile($filepath);
    } else {

        header("HTTP/1.0 404 Not Found");
        header("Content-type: image/jpeg");
        header('Content-Length: ' . filesize("404_files.jpg"));
        header("Accept-Ranges: bytes");
        header("Last-Modified: Fri, 03 Mar 2004 06:32:31 GMT");
        readfile("404_files.jpg");
    }
}

function sanitizeFilename($string = '', $is_filename = FALSE) {

    $pieces = explode('/', $string);
    $chunk = array_pop($pieces);
    $str = strip_tags($chunk);
    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
    $str = strtolower($str);
    $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
    $str = htmlentities($str, ENT_QUOTES, "utf-8");
    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
    $str = str_replace(' ', '-', $str);
    $str = rawurlencode($str);
    $str = str_replace('%', '-', $str);

    return implode(DIRECTORY_SEPARATOR, $pieces) . DIRECTORY_SEPARATOR . $str;
}

?>