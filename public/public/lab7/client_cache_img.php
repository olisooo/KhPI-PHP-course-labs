<?php
$resource_file = 'resources/image.png';
$expires_time = time() + (60 * 60 * 24 * 1);
$expires_gmt = gmdate('D, d M Y H:i:s', $expires_time) . ' GMT';


header('Cache-Control: public, max-age=86400');
header('Expires: ' . $expires_gmt);
header('Content-Type: image/png');


readfile($resource_file);