<?php

/* Sample */

require 'class.dzpreview.php';

$track_id = '12214510';
$baseurl = 'http://myserver.com/';

$path = dzpreview::getPreview($track_id);

echo $baseurl.$path;

?>