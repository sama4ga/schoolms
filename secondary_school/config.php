<?php

$DOC_ROOT= realpath(dirname(__FILE__) . '/./');
$URL_ROOT= str_replace('\\', '/', substr($DOC_ROOT, strlen(realpath($_SERVER['DOCUMENT_ROOT']))));
//echo $URL_ROOT;exit();


?>