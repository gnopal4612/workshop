<?php

// Start the session
session_start();

$_SESSION = [
    'user' => [
        'type' => 'admin',
        'passports' => []
    ],
    'settings' => [
        'view_mode' => 'full'
    ],
];