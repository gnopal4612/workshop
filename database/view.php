<?php
////////////////////////////////////////////////////////////////////////////////
// PREPARE
////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';

/// page variables ///
$device = [];

////////////////////////////////////////////////////////////////////////////////
// REQUEST-PROCESSING
////////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;

    if (isset($request['id']) && !empty($request['id']))
    {
        $search = new Cosmos([
            'query' => sprintf("SELECT * FROM `%s` WHERE `id`=?", $request['table_name']),
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
if (empty($device))
{
    exit;
}
?>
<div class="container">
    <h6>View Device</h6>

    <div class="row">
        <div class="col-8">
            <?php
            foreach ($device as $k => $v)
            {
            ?>
            <div class="input-group mb-1">
                <span class="input-group-text col-3" id="inputGroup-sizing-default"><?=ucfirst($k)?></span>
                <input name="<?=$k?>" type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="<?=$v?>">
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-2">
            <div class="input-group mb-1">
                <!-- <input class="btn btn-outline-primary" type="submit" name="submit_action" value="Update"> -->
            </div>
        </div>
    </div>
</div>






<?php
////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>