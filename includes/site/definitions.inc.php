<?php

if ($_SERVER['SERVER_PORT'] == '80')
{
    define("BASE_URL", "http://localhost/workshop/");
}
else
{
    define("BASE_URL", "http://127.0.0.1:8080/workshop/");
}

////////////////////////////
// Paths to Client Side
foreach (array_keys($sitemap) as $link)
{
    define('LINK_TO_' . strtoupper($link), BASE_URL . $link . '/');
    define('LINK_TO_' . strtoupper($link) . '_INC', BASE_URL . $link . '/includes/');
}

define('LINK_TO_INCLUDES', BASE_URL . 'includes/');
define('LINK_TO_ASSETS', LINK_TO_INCLUDES . 'assets/');

define('LINK_TO_CSS', LINK_TO_ASSETS . 'css/');
define('LINK_TO_JS', LINK_TO_ASSETS . 'js/');
define('LINK_TO_IMG', LINK_TO_ASSETS . 'img/');
define('LINK_TO_UPLOADS', LINK_TO_ASSETS . 'uploads/');
define('LINK_TO_VENDOR', LINK_TO_ASSETS . 'vendor/');


////////////////////////////
// Paths to Server Side
define('PATH_TO_INCLUDES', DOCUMENT_ROOT . 'includes/');
define('PATH_TO_UPLOADS', PATH_TO_INCLUDES . 'assets/uploads/');

foreach (array_keys($sitemap) as $link)
{
    define('PATH_TO_' . strtoupper($link), DOCUMENT_ROOT . $link . '/');
    define('PATH_TO_' . strtoupper($link) . '_INC', DOCUMENT_ROOT . $link . '/includes/');
}



define('PATH_TO_HTML_INC', PATH_TO_INCLUDES . 'html/');

define('PUBLIC_HTML_HEADER', PATH_TO_HTML_INC . 'header.inc.php');
define('PUBLIC_HTML_FOOTER', PATH_TO_HTML_INC . 'footer.inc.php');

define('ADMIN_HTML_HEADER', PATH_TO_HTML_INC . 'admin-header.inc.php');
define('ADMIN_HTML_FOOTER', PATH_TO_HTML_INC . 'admin-footer.inc.php');

define('ADMIN_HTML_SIDEBAR', PATH_TO_HTML_INC . 'sidebar.inc.php');