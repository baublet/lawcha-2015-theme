<?php

/* Simple way to output random images in this directory. */
function valid_type($needle) {
	$image_types = array('jpg','gif','png');
	if(strlen($needle > 4)) $needle = substr($needle, -3);
	else return FALSE;
	return in_array($needle, $image_types);
}

$files = scandir(dirname(__FILE__));
$images = array();

foreach($files as $filename) {
	if(valid_type($filename)) $images[] = $filename;
}

if(!count($images)) die('No images!');

$thefile = array_rand($images);
$imginfo = getimagesize($images[$thefile]);
header("Cache-Control: private, max-age=10800, pre-check=10800");
header("Pragma: private");
header("Expires: " . date(DATE_RFC822,strtotime("7 days")));
header("Content-type: {$imginfo['mime']}");
readfile($images[$thefile]);