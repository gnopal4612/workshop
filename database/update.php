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

    if (isset($request['empty']) && !empty($request['empty']))
    {
        $create = new Cosmos([
            'query' => sprintf("TRUNCATE TABLE `%s`", $request['empty']),
            'args' => []
        ]);

        $create->execute();
    }

    if (isset($request['drop']) && !empty($request['drop']))
    {
        $create = new Cosmos([
            'query' => sprintf("DROP TABLE `%s`", $request['drop']),
            'args' => []
        ]);

        $create->execute();
    }
}

////////////////////////////////////////////////////////////////////////////////
// DATA-PROCESSING
////////////////////////////////////////////////////////////////////////////////
$tables = fetch_existing_tables();

////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////
?>
<form class="container" action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-2">Table</th>
                <th class="col-2">#records</th>
                <th></th>
                <th class="col-1 text-center">View</th>
                <th class="col-1 text-center">Import</th>
                <th class="col-1 text-center">Empty</th>
                <th class="col-1 text-center">Drop</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($tables as $wrk) 
{
?>
            <tr>
                <td><?=$wrk['table']?></td>
                <td><?=$wrk['count']?></td>
                <td></td>
                <td class="text-center">
                    <a class="btn btn-outline-info" href="<?=LINK_TO_DATABASE?>index.php?table_name=<?=$wrk['table']?>"
                        role="button">
                        <?=$icons['view']?>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-info" href="<?=LINK_TO_DATABASE?>import.php?table_name=<?=$wrk['table']?>"
                        role="button">
                        <?=$icons['upload']?>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-info" href="<?=$_SERVER['SCRIPT_NAME']?>?empty=<?=$wrk['table']?>"
                        role="button">
                        <?=$icons['snowplow']?>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-info" href="<?=$_SERVER['SCRIPT_NAME']?>?drop=<?=$wrk['table']?>"
                        role="button">
                        <?=$icons['trash']?>
                    </a>
                </td>
            </tr>
            <?php
}
?>
        </tbody>
    </table>
</form>


<?php

////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>