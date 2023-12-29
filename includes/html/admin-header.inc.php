<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <script src="<?=LINK_TO_JS?>color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" href="<?=LINK_TO_VENDOR?>bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FontAwesome CSS -->
    <link type="text/css" href="<?=LINK_TO_VENDOR?>fontawesome-free-6.4.2-web/css/all.css" rel="stylesheet" />

    <!-- Bootstrap Dashboard -->
    <!-- <link type="text/css" href="<?=LINK_TO_CSS?>dashboard.css" rel="stylesheet" /> -->

    <meta name="theme-color" content="#712cf9">

    <title><?=$html['title'];?></title>

</head>

<body id="<?=$html['script']?>">
    <!-- Fixed Theme Toggle -->
    <?php require_once (PATH_TO_HTML_INC . 'theme-toggle.inc.php'); ?>

    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">

        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="<?=LINK_TO_DASHBOARD?>index.php">Green
            Bean</a>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                    aria-label="Toggle search">
                    <svg class="bi">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
            </li>
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg class="bi">
                        <use xlink:href="#list"></use>
                    </svg>
                </button>
            </li>
        </ul>
        <div id="navbarSearch" class="navbar-search w-100 collapse">
            <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        </div>
    </header>

    <div class="container-fluid">

        <div class="row">

            <!-- Side Navigation-->
            <?php 
    // if ($_SESSION['settings']['view_mode'] == 'full')
    // {
        require_once (PATH_TO_HTML_INC . 'sidebar.inc.php'); 
    // }

?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <form class="container" action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                                <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Top</button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Dev</button> -->

                                <input type="submit" name="submit_mode" class="btn btn-sm btn-outline-secondary"
                                    value="Tablet">

                                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            </form>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                            This week
                        </button>
                    </div>
                </div>