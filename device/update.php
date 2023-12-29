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
		if ($request['submit_action'] == 'Update')
		{
            
            $request['id'] = $request['form']['id'];  /// trigger GET[id] condition

			$update['fields'] = array_slice(array_keys($request['form']), 2);
            unset($update['fields']['id'], $update['fields']['timestamp']);
            
            $set = [];
            foreach ($update['fields'] as $f)
            {
                $set[] = "`{$f}` = ?";
                $sql['args'][] = $request['form'][$f];
            }

            $sql['query'] = "UPDATE `inventory` SET " . implode(', ', $set) . " WHERE `id` = ?";
            $sql['args'][] = $request['id'];

            $up = new Cosmos([
                'query' => $sql['query'],
                'args' => $sql['args']
            ]);

            $up->execute();
		}
    }

    if (isset($request['id']) && !empty($request['id']))
    {
        $search = new Cosmos([
            'query' => "SELECT * FROM `inventory` WHERE `id`=?",
            'args' => [$request['id']]
        ]);
        
        $device = $search->fetch();
    }
}

////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////
if (empty($device) || empty($request))
{
    echo 'Missing identifier';
    exit;
}

?>
<form class="container" action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="">
    <h6>Edit Device</h6>

    <div class="row">
        <div class="col-6">
            <?php
            foreach ($device as $k => $v)
            {
            ?>
            <div class="input-group mb-1">
                <span class="input-group-text col-3" id="inputGroup-sizing-default"><?=ucfirst($k)?></span>
                <input name="form[<?=$k?>]" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="<?=$v?>">
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-2">
            <div class="input-group mb-1">
                <input class="btn btn-outline-primary" type="submit" name="submit_action" value="Update">
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