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


    

}

////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
////////////////////////////////////////////////////////////////////////////////
$search = new Cosmos([
    'query' => "SELECT * FROM `inventory`",
    'args' => []
]);

$devices = $search->fetchAll();

////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////
if (empty($devices))
{
    exit;
}
?>
<div class="container">
    <h6>Devices</h6>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <?php    
                    foreach (array_keys($devices[0]) as $th)
                    {
                        echo '<th>' . $th . '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($devices as $i => $device) {
                    $query_string = http_build_query([
                        'id' => $device['id']
                    ]);
                ?>
                <tr>
                    <td>
                        <a class="btn btn-outline-info" href="<?=LINK_TO_DEVICE?>view.php?<?=$query_string?>"
                            role=" button">
                            <?=$icons['view']?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-outline-info" href="<?=LINK_TO_DEVICE?>update.php?<?=$query_string?>"
                            role=" button">
                            <?=$icons['edit']?>
                        </a>
                    </td>
                    <?php 
                    foreach ($device as $dk => $dv) {
                        echo '<td>' . $dv . '</td>';
                    }
                    ?>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>