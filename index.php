<?php
session_start();
$selectedDomains = null;
if (isset($_SESSION['domain_data'])) {
    $selectedDomains = json_decode($_SESSION['domain_data']);
}
?>

<html lang="en">
    <head>
        <title>Domein Zoeker</title>
        <link href="stylesheets/common.css" rel="stylesheet">
    </head>
    <body>
        <form class="form-layout container-default" name="domein-selector">
            <label for="domein-naam">
                Typ hier uw gewenste domein naam op.
                <input type="text" id="domein-naam" name="domein-naam" required>
            </label>
            <label for="domein-extensie">
                Typ hier uw gewenste domein extensie op (com, nl, enzovoort).
                <input type="text" id="domein-extensie" name="domein-extensie" required>
            </label>
            <button class="knop-default" type="button" onclick="Add_Domain()">Voeg domein toe aan selectie</button>
        </form>
        <div class="container-default" id="domein-container"></div>
        <form name="domein-zoek-formulier" action="functions/php/SearchDomains.php" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="geselecteerde-domeinen" id="geselecteerde-domeinen" value="hi">
            <input type="submit" name="domein-zoekknop" id="domein-zoekknop" value="Bekijk beschikbaarheid">
        </form>
    <?php
    if (isset($_SESSION['domain_data'])) {
        echo '<div class="selected-domains container-default"><p>Huidig geselecteerde domeinen:</p>';
        foreach ($selectedDomains as $domain) {
            echo '<p>'.$domain->domain.'<p>';
        }
        echo '<a class="knop-default" href="views/checkout.php">Bekijk uw huidig geselecteerde domeinen</a></div>';
    }
    ?>
    </body>
<script src="functions/js/HandleDomains.js" type="application/javascript"></script>
</html>
