<?php
///////////////////////////////////////////////////////////////////////////////////
// PREPARE
///////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT'] . '/workshop/includes/site/prepare.inc.php';

///////////////////////////////////////////////////////////////////////////////////

// REQUEST-PROCESSING
///////////////////////////////////////////////////////////////////////////////////

if (isset($_REQUEST) && !empty($_REQUEST))
{
    // @TODO - set up cleanup
    $request = $_REQUEST;

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




<?php
///////////////////////////////////////////////////////////////////////////////////
// END OUTPUT
///////////////////////////////////////////////////////////////////////////////////
require_once ADMIN_HTML_FOOTER;
///////////////////////////////////////////////////////////////////////////////////
?>