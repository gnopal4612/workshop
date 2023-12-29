<?php

define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT'] . '/workshop/');

$SITE_REQUIRES = [
    'variables',
    'definitions',    
    'session',
    'db',
    'functions',
    // 'validation',
    'html',
    'stylesheets'
];

foreach ($SITE_REQUIRES AS $include)
{
    require_once DOCUMENT_ROOT . "includes/site/{$include}.inc.php";
}

require_once DOCUMENT_ROOT . 'developer/includes/functions.inc.php';

unset($SITE_REQUIRES);