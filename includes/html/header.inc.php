<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link type="text/css" href="<?=LINK_TO_VENDOR?>bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?=LINK_TO_VENDOR?>fontawesome-free-6.4.2-web/css/all.css" rel="stylesheet">

    <link type="text/css" href="<?=LINK_TO_CSS?>/main.css" rel="stylesheet">

    <?php
if (!empty($html['stylesheets']))
{
    foreach ($html['stylesheets'] as $ss)
    {
        echo $ss;
    }
}
?>

    <title><?=$html['title']?></title>

</head>

<body id="<?=$html['script']?>">