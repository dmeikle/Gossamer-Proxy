
this page needs styling...<br><br>

<?php


$page = current($CmsPage);
$locale = $this->getDefaultLocale();

echo $page['locales'][$locale['locale']]['content'];

?>