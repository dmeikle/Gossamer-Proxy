<?php


$string = "<img src='@components/cssmenu/includes/images/mypic.jpg' />";
echo 'try';
//echo preg_replace('/(<img.*?src="\@components)(\/[^/]*)([^"]*?(\/[^/]*\.[^"]+))/g', '<img src="\/images\/components$2$4', $string);
echo preg_replace("/src='(?:[^'\/]*\/)*([^']+)'/g","src='newPath/$2'",$string);

echo $string;
    echo 'done';
    ?>