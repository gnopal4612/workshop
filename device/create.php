<?php
////////////////////////////////////////////////////////////////////////////////
// PREPARE
////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';


////////////////////////////////////////////////////////////////////////////////
// REQUEST-PROCESSING
////////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;


    if (isset($request['submit_action']) && !empty($request['submit_action']))
    {
		if ($request['submit_action'] === 'Create')
		{        
			if (isset($request['form']) && !empty($request['form']))
			{
                insert_asset('inventory', [$request['form']]);
			}
		} /// end submit_action == Create
    } /// isset && !empty(submit action)
}

////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
////////////////////////////////////////////////////////////////////////////////
$form_fields = get_table_fields('inventory');


////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////

?>
<form class="container" action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="">
    <h6>Create Device</h6>

    <div class="row">
        <div class="col-8">
            <?php
            foreach ($form_fields as $f)
            {
            ?>
            <div class="input-group mb-1">
                <span class="input-group-text col-3" id="inputGroup-sizing-default"><?=ucfirst($f)?></span>
                <input name="form[<?=$f?>]" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="">
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-2">
            <div class="input-group mb-1">
                <input class="btn btn-outline-primary" type="submit" name="submit_action" value="Create">
            </div>
        </div>
    </div>
</form>



<?php
////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>