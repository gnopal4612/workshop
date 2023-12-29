<?php

$html['stylesheets'] = [];

if ($_SERVER['SCRIPT_NAME'] == '/workshop/login.php')
{
	$html['stylesheets'][] = '<link type="text/css" href="' . BASE_URL . 'assets/css/login.css" rel="stylesheet">';
}