<?php

/// site map /// 
$sitemap = [
    'public' => [
        'login',        
    ], 
    'dashboard' => [
        'index'        
    ],     
    'device' => [
        'create',
        'update', 
        'index',
        'view'   
    ], 
    'database' => [
        'create-table',
        'update', 
        'import',
        'index',
        'view'     
    ], 
    'network' => [
        'create', 
        'update', 
        'index'
    ],
    'developer' => [
        'create',
        'update',
        'index',      
    ], 
    'playground' => [
        'create',
        'update', 
        'index'         
    ],
];

/// html script ///
$tmp_script = explode('/', str_replace ('.php', '', $_SERVER['SCRIPT_NAME']));
$html = [
    'title' => ucwords($tmp_script[(count($tmp_script) - 2)] . ' - ' . $tmp_script[(count($tmp_script) - 1)]),
    'script' => $tmp_script[(count($tmp_script) - 2)] . '_' . $tmp_script[(count($tmp_script) - 1)]
];

/// db suggestions ///
$field_suggestions = [
    'status'    => 'status,device_type,serial,mac_address,model,name,title',
    'network'   => 'ip_address,protocol,lease_expiration,description',
    'location'  => 'location,room,panel,idf,switch,port',
    'users'     => 'fname,lname,username,subject,role,extension,planning,last_login_date,balance_insurance',
    
    'luxriot'   => 'cam_server,recording,cam_driver',
    'tickets'   => 'ticket_no,issue,requested_for',
    'incidentiq' => 'location,funding_source,asset_type',
    'google'    => 'last_policy_sync,annotated_user,annotated_location,recent_activity,recent_user',
];

/// html icons ///
$icons = [
    'database'	=> '<i class="fa-solid fa-database nav_icon"></i>',
    'tickets'	=> '<i class="fa-solid fa-ticket nav_icon"></i>',
    'users' 	=> '<i class="fa-solid fa-user nav_icon"></i>',
    'import' 	=> '<i class="fa-solid fa-file-import nav_icon"></i>',
    'reports' 	=> '<i class="fa-solid fa-chart-pie nav_icon"></i>',
    'network'   => '<i class="fa-solid fa-network-wired"></i>',
    'trash'     => '<i class="fa-solid fa-trash"></i>',
    'snowplow'  => '<i class="fa-solid fa-snowplow"></i>',
    'upload'    => '<i class="fa-solid fa-upload"></i>',
    'view'      => '<i class="fa-solid fa-eye"></i>',
    'edit'      => '<i class="fa-solid fa-pen-to-square"></i>'    
];