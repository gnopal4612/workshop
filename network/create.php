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
$stack_config = [
    'mdf' => [
        ['A', 'panel', 48],
        ['E', 'panel', 12],
        ['W', 'panel', 12],
        [1, 'switch', 48],
        ['B', 'panel', 48],
        [2, 'switch', 48],
        ['C', 'panel', 48],
        [3, 'switch', 48],
        ['F', 'panel', 48],
        [4, 'switch', 48],
        ['G', 'panel', 48],
        [5, 'switch', 48],
        ['H', 'panel', 48],
        [6, 'switch', 48],
        ['I', 'panel', 48],
        [7, 'switch', 48],
        ['J', 'panel', 48],
    ],
    'idf100' => [
        ['A', 'panel', 12],
        [1, 'switch', 48],
        ['B', 'panel', 48],
        [2, 'switch', 48],
        ['C', 'panel', 24],   
        ['D', 'panel', 12],
        ['E', 'panel', 12]
    ],
    'idf200' => [
        ['A', 'panel', 12],
        [1, 'switch', 48],
        ['B', 'panel', 48],
        [2, 'switch', 48],
        ['C', 'panel', 48],
        [3, 'switch', 48],
        ['D', 'panel', 48],
        [4, 'switch', 48],
        ['E', 'panel', 48],
        ['F', 'panel', 24]
    ],
    'idf300' => [
        ['A', 'switch', 48],
        ['B', 'switch', 48],
        ['C', 'switch', 48],
        [1, 'switch', 48],
        ['D', 'panel', 48],
        ['', 'panel', 24],
        ['', 'panel', 12],
        ['', 'panel', 12],
        [2, 'switch', 48],
        ['E', 'panel', 48],
        [3, 'switch', 48],
        ['', 'panel', 24],
        ['I', 'panel', 24],
        [4, 'switch', 48],
        ['', 'panel', 48],
        [5, 'switch', 48],
        ['', 'panel', 48],
        ['', 'panel', 24]
    ],
    'idf700' => [
        ['', 'panel', 48],
        [1, 'switch', 48],
        
        ['', 'panel', 24],

        ['A', 'panel', 48],
        [1, 'switch', 48],      
        ['B', 'panel', 48],
        [2, 'switch', 48],      
        ['C', 'panel', 48],
        [3, 'switch', 48],      
        ['', 'panel', 48],
        [4, 'switch', 48],      
        ['D', 'panel', 48],
        [5, 'switch', 48],      
        ['E', 'panel', 48],
        [6, 'switch', 48],      
        ['F', 'panel', 48],
        [7, 'switch', 48],      
        ['W', 'panel', 48],
        [8, 'switch', 48]      
    ],
];

$network = [];
foreach ($stack_config as $loc => $stack)
{
    foreach ($stack as $i => $endpoint)
    {
        $network[$loc][$i] = [
            'label' => $endpoint[0],
            'type' => $endpoint[1],
            'num_ports' => $endpoint[2],
        ];
    }
}


////////////////////////////////////////////////////////////////////////////////
// OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_HEADER;
////////////////////////////////////////////////////////////////////////////////
$offcanvas_btn = ""

?>

<button class="btn btn-primary" 
type="button" 
data-bs-toggle="offcanvas"
data-bs-target="#offcanvasScrolling" 
aria-controls="offcanvasScrolling">
    Enable body scrolling
</button>

<a class="btn btn-primary" 
    data-bs-toggle="offcanvas" 
    href="#offcanvasScrolling" 
    role="button" 
    aria-controls="offcanvasScrolling">
  Link with href
</a>



<style>
table {
    width: 1280px;
}

.panel-hub {
    border: 2px solid blue;
}

.switch-hub {
    border: 2px solid #fa6605;
}

.panel-hub .device-label {
    border: 2px solid blue;
    width: 50px;
}

.switch-hub .device-label {
    border: 2px solid #fa6605;
    width: 50px;
}

.panel-hub td{
    border: 1px solid blue;
}

.panel-hub .room-label {
    background-color: #31D2F2;
    height: 15px;
}

.panel-hub .panel-label {
    height: 50px;
}

.switch-hub .switch-label{
    border: 1px solid #fa6605;
    height: 50px;
    width: 50px;
}

.divider {
    height: 10px;
}

.switch-active {
    border: 3px solid red;
}

</style>


<?php
// Process        location > panel, > idf > switch > port > device

// panel        room, panel (letter/number), port
// switch       switch, port, panel, device, vlan (if not device)


// full switches
//      will require odd increments

// full panels

// partial panels

function build_network_table($settings)
{
    $label_row1 = "";
    $panel_row1 = "";   
    $label_row2 = "";
    $panel_row2 = "";
    
    if ($settings['type'] == 'panel')
    {
        if ($settings['num_ports'] < 25)
        {
            for ($i = 1; $i <= $settings['num_ports']; $i++)
            {
                $label_row1 .= "<td class=\"room-label text-center\">Rm {$i}</td>";
                $panel_row1 .= "<td class=\"panel-label text-center\">{$i}</td>"; 
            }
        }

        if ($settings['num_ports'] > 24)
        {
            for ($i = 1; $i <= 24; $i++)
            {
                $label_row1 .= "<td class=\"room-label text-center\">Rm {$i}</td>";
                $panel_row1 .= "<td class=\"panel-label text-center\">{$i}</td>"; 
            }
            for ($i = 25; $i <= $settings['num_ports']; $i++)
            {
                $label_row2 .= "<td class=\"room-label text-center\">Rm {$i}</td>";
                $panel_row2 .= "<td class=\"panel-label text-center\">{$i}</td>"; 
            }
        }
    }

    if ($settings['type'] == 'switch')
    {
        for ($i = 1; $i <= 48; $i++)
        {
            if ($i % 2 == 0)
            {
                $panel_row2 .= "<td class=\"switch-label text-center\">{$i}</td>";   
            }
            else
            {
                // $panel_row1 .= "<td class=\"switch-label text-center\">{$i}</td>";
                $panel_row1 .= "
                <td class=\"switch-label text-center\">
                    <a class=\"btn btn-primary\" href=\"{$_SERVER['SCRIPT_NAME']}?{$settings['type']}={$settings['label']}_{$i}\">
                        {$i}
                    </a>
                </td>";
            }
        } 
    }

    $table[] = "
        <table class=\"{$settings['type']}-hub mb-2\">
            <tr>
                <td class=\"device-label text-center \" rowspan=\"5\">
                    {$settings['label']}
                </td>
                {$label_row1}                
            </tr>
            <tr>
                {$panel_row1}
            </tr>
            <tr>
                <td class=\"divider\" colspan=\"24\"></td>
            </tr>
            <tr>
                {$label_row2}
            </tr>
            <tr>
                {$panel_row2}
            </tr>            
        </table>
    ";

    return implode('', $table);
}

foreach ($network['mdf'] as $settings)
{
    echo build_network_table($settings);

    // break;
}

?>

    


















<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>



<?php
////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
////////////////////////////////////////////////////////////////////////////////
?>