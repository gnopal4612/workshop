<?php
///////////////////////////////////////////////////////////////////////////////////
// PREPARE
///////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';
require_once 'includes/import_csv.inc.php';


/// page variable ///
$table_name = '';

///////////////////////////////////////////////////////////////////////////////////
// REQUEST-PROCESSING
///////////////////////////////////////////////////////////////////////////////////

if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;

    /// Step 1: Collect Table Fields
    if (isset($request['table_name']) && !empty($request['table_name'])) 
    {
        $table_name = $request['table_name'];
        $form_fields = get_table_fields($request['table_name']); 
    }

	if (isset($request['submit_action']) && !empty($request['submit_action']))
	{
        if ($request['submit_action'] === 'Update')
        {
            /// Step 2: Collect Filename Fields
            if (isset($request['file']) && !empty($request['file']))
            {
                $csv_file = new Import_CSV($request['file']);

                $csv['headers'] = $csv_file->get_headers();
            }
        }
        else if ($request['submit_action'] === 'Import')
		{
            $csv_file = new Import_CSV($request['filename']);
            $csv_data = $csv_file->get_data();

            $mapped_data = [];
                     
            foreach ($csv_data as $i => $csv_record)
            {
                foreach ($request['form'] as $input_field => $csv_field)
                {
                    $mapped_data[$i][$input_field] = !empty($csv_record[$csv_field]) ? $csv_record[$csv_field] : '';
                }
                $i++;
                // break;
            }

            insert_asset($request['table_name'], $mapped_data);     
        
        }
    }

}

///////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
///////////////////////////////////////////////////////////////////////////////////
// $tables = fetch_existing_tables();

// $form = new HTML($form_fields);



///////////////////////////////////////////////////////////////////////////////////
// OUTPUT
///////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
///////////////////////////////////////////////////////////////////////////////////

?>
<form class="" name="upload_form" action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST">
    <h6>Import from CSV</h6>

    <div class="row">
        <div class="col-4">
            <div class="input-group mb-2">
                <span class="input-group-text" id="inputGroup-sizing-default">Table Name</span>
                <input name="table_name" type="text" id="" class="form-control" aria-label=""
                    aria-describedby="inputGroup-sizing-default" value="<?=$table_name?>">
            </div>
        </div>
        <div class="col-6">
            <div class="input-group mb-2">
                <input name="file" type="file" class="form-control" id="inputGroupFile02">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group mb-2">
                <input class="btn btn-primary" type="submit" name="submit_action" value="Update">
            </div>
        </div>
    </div>
<hr>
    <h6>CSV Mapping</h6>
    <div class="row">
        <div class="col-6">
            <div class="input-group mb-1">
                <span class="input-group-text col-3" id="inputGroup-sizing-default">Table</span>
                <input name="table_name" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default"
                    value="<?=$table_name?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="input-group mb-3">
                <span class="input-group-text col-3" id="inputGroup-sizing-default">CSV File</span>
                <input name="filename" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default"
                    value="<?=isset($request['file']) ? $request['file'] : ''?>">
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col-6">            
<?php
if (!empty($table_name))
{
foreach ($form_fields as $field)
{
?>
            <div class="input-group mb-1">
                <span class="input-group-text col-3" id="inputGroup-sizing-default"><?=ucfirst($field)?></span>
                <select name="form[<?=$field?>]" class="form-select" aria-label="Default select example">
                    <option></option>
<?php
    foreach ($csv['headers'] as $header)
    {
        $selected = '';
        if ($field == $csv_field || str_contains($header, $field))
        {
            $selected = 'selected';
        }

        echo '<option ' . $selected . '>' . $header . '</option>';
    }
?>
                </select>
            </div>
<?php
}
?>
        </div>
        <div class="col-2">
            <div class="input-group mb-2">
                <input class="btn btn-primary" type="submit" name="submit_action" value="Import">
            </div>
        </div>
<?php
}
?>
    </div>









</form>


<?php
// reveal($request);
// reveal($csv_headers);

// reveal($csv);
///////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
///////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
///////////////////////////////////////////////////////////////////////////////////
?>