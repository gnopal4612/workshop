
<div class="sidebar border border-right col-0 col-lg-2 p-0 bg-body-tertiary">
    <?php
foreach ($sitemap as $sitearea => $sitelinks)
{
    echo '<hr>' . ucfirst($sitearea) . '<ul>';

    foreach ($sitelinks as $link)
    {
        echo '<li><a href="' . BASE_URL . "{$sitearea}/{$link}.php" . '">' . $link . '</a></li>';
    }
    echo '</ul>';
}
?>

</div> <!-- end of sidebar -->