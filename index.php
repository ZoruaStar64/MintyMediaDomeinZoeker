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
        <link href="" rel="stylesheet">
    </head>
    <body>
        <form name="domein-selector">
            <label for="domein-naam">
                Typ hier uw gewenste domein naam op.
                <input type="text" id="domein-naam" name="domein-naam" required>
            </label>
            <label for="domein-extensie">
                Typ hier uw gewenste domein extensie op (com, nl, enzovoort).
                <input type="text" id="domein-extensie" name="domein-extensie" required>
            </label>
            <button type="button" onclick="Add_Domain()">Voeg domein toe aan selectie</button>
        </form>
        <div id="domein-container"></div>
        <form name="domein-zoek-formulier" action="SearchDomains.php" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="geselecteerde-domeinen" id="geselecteerde-domeinen" value="hi">
            <input type="submit" name="domein-zoekknop" id="domein-zoekknop" value="Bekijk beschikbaarheid">
        </form>
    <?php
    if (isset($_SESSION['domain_data'])) {
        echo '<div><p>Huidig geselecteerde domeinen:</p>';
        foreach ($selectedDomains as $domain) {
            echo '<p>'.$domain->domain.'<p>';
        }
        echo '<a href="checkout.php">Bekijk uw huidig geselecteerde domeinen</a></div>';
    }
    ?>
    </body>
<script src="HandleDomains.js" type="application/javascript"></script>
</html>
