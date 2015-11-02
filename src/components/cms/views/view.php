
<?php

$page = current($CmsPage);
$locale = $this->getDefaultLocale();

echo $page['content'];
?>