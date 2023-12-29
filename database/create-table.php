<?php
///////////////////////////////////////////////////////////////////////////////////
// PREPARE
///////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';

/// page variables ///
$table = $display = [];

///////////////////////////////////////////////////////////////////////////////////
// REQUEST-PROCESSING
///////////////////////////////////////////////////////////////////////////////////

if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;

    if (isset($request['submit_action']) && !empty($request['submit_action']))
    {
		if ($request['submit_action'] === 'Create Table')
		{
			if (isset($request['table_name']) && !empty($request['table_name']) 
                && isset($request['custom_fields']) && !empty($request['custom_fields']))
			{				
				$create = new Cosmos([
					'query' => create_table_query($request['table_name'], explode(',', str_replace(' ', '', $request['custom_fields']))),
					'args' => []
				]);

				$create->execute();
			}
		} /// end submit_action == Create Table
    }
}

///////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
///////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////
// OUTPUT
///////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
///////////////////////////////////////////////////////////////////////////////////

?>
<form class="container" action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="">
    <h6> Create Table </h6>
    <div class="row">
        <div class="col-12">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text col-2" id="inputGroup-sizing-default">Table Name</span>
                <input name="table_name" type="text" id="" class="form-control" aria-label=""
                    aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text col-2" id="inputGroup-sizing-default">Custom Fields</span>
                <textarea name="custom_fields" id="custom_fields" class="form-control"
                    aria-label="With textarea"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-10"></div>
        <div class="col-2 text-end">
            <input class="btn btn-outline-primary" type="submit" name="submit_action" value="Create Table">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
<?php
        foreach ($field_suggestions as $tbl => $fsg) 
        { 
            echo '<div class="input-group mb-2">';
            echo '<span class="input-group-text col-2" id="inputGroup-sizing-default">' . $tbl . '</span>';
            
            foreach (explode(',', $fsg) as $f) 
            {
?>
                <button type="button" class="btn btn-outline-info" onclick="addText(event)"><?=$f?></button>
<?php 
            }
            echo '</div>';
        } 
?>
            </div>
        </div>
    </div>
</form>

<script>
	function addText(event) {
		var targ = event.target || event.srcElement;
		if (document.getElementById("custom_fields").value === "") 
		{
			document.getElementById("custom_fields").value += targ.textContent || targ.innerText;
		}
		else 
		{
			document.getElementById("custom_fields").value += ', ' + targ.textContent || targ.innerText;
		}
	}
	
	function setInput(field, newInput) {
        document.getElementById(field).value = newInput;
    }
</script>

<?php

///////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
///////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
///////////////////////////////////////////////////////////////////////////////////
?>