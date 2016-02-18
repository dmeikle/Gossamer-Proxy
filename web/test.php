<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo "PHP GD library is installed on your web server";
} else {
    echo "PHP GD library is NOT installed on your web server";
}
?>

<?php
echo 'testing';
?>
<script src="/compression/js?files=js/test.js"></script>