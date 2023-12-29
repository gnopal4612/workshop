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
    if (isset($request['table_name']) && isset($request['table_name']))
    {
        $search = new Cosmos([
            'query' => "SELECT * FROM `" . $request['table_name'] . "`",
            'args' => []
        ]);

        $results = $search->fetchAll();     
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            foreach ($tables as $table) {
            ?>
            <a class="btn btn-outline-success" href="index.php?table_name=<?=$table['table']?>">
                <?=$table['table']?> (<?=$table['count']?>)
            </a>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
    if (!empty($results)) 
    {
    ?>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th></th>
                    <?php    
        foreach (array_keys($results[0]) as $th)
        {
            echo '<th>' . $th . '</th>';
        }
        ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $i => $device) {
                    $query_string = http_build_query([
                        'id' => $device['id'],
                        'table_name' => $request['table_name']
                    ]);
                ?>
                <tr>
                    <td>
                        <a class="btn btn-outline-info" href="<?=LINK_TO_DATABASE?>view.php?<?=$query_string?>"
                            role=" button">
                            <?=$icons['view']?>
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
    <?php
    }
    ?>

</div>
<?php

////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>