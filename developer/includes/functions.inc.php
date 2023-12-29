<?php
$scouter = [];
////////////////////////////////////////////////////////////////////////////////
// FUNCTION reveal()
////////////////////////////////////////////////////////////////////////////////
function reveal($var, $mode = '')
{
    echo '<pre style="border:1px solid #fa6605; font-size: 10px;margin: 20px; z-index: 1000 !important;">';

    switch ($mode) {
        case 'export':
            var_export($var);
            break;
        case 'list':
            echo '[<br />';
            foreach ($var as $v) {
                echo "'" . $v . "' => '', <br />";

            }
            echo '];';
            break;

        default:
            print_r($var);
            break;
    }

    echo '</pre>';
}

////////////////////////////////////////////////////////////////////////////////
// FUNCTION str_to_list()
////////////////////////////////////////////////////////////////////////////////
function str_to_list($var)
{
    $temp_var = preg_split('/\r\n|\r|\n/', $var);
    $next_var = [];

    foreach ($temp_var as $key => $val) {
        $next_var[] = strtolower(str_replace(' ', '_', $val));
    }

    return $next_var;
}

////////////////////////////////////////////////////////////////////////////////
// FUNCTION list_to_files()
////////////////////////////////////////////////////////////////////////////////
function list_to_files($var)
{
    foreach ($var as $key => $val) {
        echo $val . '<br />';
        fopen("../assets/content/{$val}.txt", "w");
    }
}

////////////////////////////////////////////////////////////////////////////////
// FUNCTION print_form_field_structure()
////////////////////////////////////////////////////////////////////////////////
function print_form_field_structure($array = [])
{
    echo '<pre style="font-size: 10px;">';

    foreach ($array as $f) {
        echo sprintf("
    '%s' => [
        'input' => 'text',
        'label' => '%s',
        'properties' => [
            'name' => '%s',
            'id' => '%s'
        ],
    ],
    ", $f, ucfirst($f), $f, $f);
    }
    echo '</pre>';
}