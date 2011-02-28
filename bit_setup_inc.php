<?php
global $gBitSystem, $gBitSmarty, $gBitThemes;

$registerHash = array(
	'package_name' => 'libertysyndication',
	'package_path' => dirname(__FILE__).'/',
	'homeable' => FALSE,
);
$gBitSystem->registerPackage($registerHash);

