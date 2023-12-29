<?php

/// gather all from JHS
$search = new Cosmos([
    'query' => "SELECT status, asset_tag, manufacturer, model, last_sync_date
                FROM incidentiq
                WHERE location_abbreviation = ?
                ORDER BY model DESC",
    'args' => ["JHS"]
]);

// $search = new Cosmos([
//     'query' => "SELECT iq.id, iq.status, iq.model, iq.asset_tag, iq.location_abbreviation, 
//                              iq.location_details, iq.funding_source, iq.po_number, iq.last_sync_date, iq.last_login_date,
//                              ds.device, ds.room
//                 FROM `incidentiq` as iq
//                 INNER JOIN `des_scanned` as ds
//                 ON iq.asset_tag = ds.serial
//                 WHERE iq.location_abbreviation = ?",
//     'args' => ["DES"]
// ]);

// (SELECT device FROM `des_scanned` WHERE serial = iq.asset_tag) as device_type,


// $search = new Cosmos([
//     'query' => "SELECT iq.id, iq.status, iq.model, iq.asset_tag, iq.location_abbreviation,
//                             (SELECT room FROM `des_scanned` WHERE serial = iq.asset_tag) as location_details,
//                             iq.location_details, iq.funding_source, iq.po_number, iq.last_sync_date, iq.last_login_date                             
//                 FROM `incidentiq` as iq
//                 WHERE iq.location_abbreviation = ?",
//     'args' => ["DES"]
// ]);

// $devices = $search->fetchAll();


// $search = new Cosmos([
//     'query' => "SELECT *
//                 FROM `des_scanned`
//                 ORDER BY device ASC",
//     'args' => []
// ]);

// $search = new Cosmos([
//         'query' => "SELECT COUNT(serial)
//                     FROM `google`
//                     WHERE device_type = ? 
//                         AND annotated_location = ?",
//         'args' => ['HP Chromebook 11MK G9 EE', 'Jackson High School']
// ]);



/// GET DISCTINCT VALUES
$fields = new Cosmos([
    'query' => "SELECT DISTINCT device_type
                FROM `google`",
    'args' => []
]);

$distinct_fields = $fields->fetchAll();

// reveal($distinct_fields);

$device_models = [];
foreach ($distinct_fields as $i => $dev)
{
    $device_models[] = $dev['device_type'];

}

// reveal($device_models);


$search = new Cosmos([
    'query' => "SELECT device_type, annotated_location, count(*) as num_of_devices
                FROM `google`
                GROUP BY annotated_location, device_type",
    'args' => []
]);

$devices = $search->fetchAll();
// reveal($devices);

$final_counts = [];
foreach ($devices as $i => $dc)
{
    foreach ($device_models as $model)
    {
        $final_counts[$model][$dc['annotated_location']] = '';
        if (isset($dc['device_type']) && $dc['device_type'] == $model)
        {
            $final_counts[$dc['device_type']][$dc['annotated_location']] = $dc['num_of_devices'];
        }


    }
}

reveal($final_counts);
