<?php
////////////////////////////////////////////////////////////////////////////////
// PREPARE
////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';

require_once PATH_TO_DATABASE_INC . 'model.inc.php';
require_once PATH_TO_DATABASE_INC . 'import_csv.inc.php';


/// page variables ///
$html = [
    'title' => 'Import',
    'script' => ''
];
$dev = [];

////////////////////////////////////////////////////////////////////////////////
// PRE-PROCESSING
////////////////////////////////////////////////////////////////////////////////
$dir_files = scandir(PATH_TO_UPLOADS . 'dhcp');
unset($dir_files[0], $dir_files[1]);

/// write to file
$new_file = fopen(PATH_TO_UPLOADS . 'dhcp.csv', "a");

$i = 1;
foreach ($dir_files as $file)
{
	$csv = new Import_CSV($file, '/workshop/includes/assets/uploads/dhcp/');
	$data = $csv->get_data();

	if ($i == 1)
	{
		$headers = $csv->get_headers();
		fwrite($new_file, implode(',', array_values($headers)) . "\n");
	}

	foreach ($data as $row)
	{
		fwrite($new_file, implode(',', array_values($row)) . "\n");
	}

	$i++;
}

fclose($new_file);
////////////////////////////////////////////////////////////////////////////////
// REQUEST-PROCESSING
////////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;


}

////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////

?>



<?php
echo "<fieldset>" . reveal($dev) . "</fieldset>";
////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>