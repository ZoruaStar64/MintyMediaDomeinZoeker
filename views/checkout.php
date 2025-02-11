<?php
session_start();
$domain_data = json_decode($_SESSION['domain_data']);
$total_price = 0;
$sub_total = 0;
$BTW_price = 0;
foreach ($domain_data as $domain) {
    if ($domain->status == "free") {
        $sub_total += $domain->price->product->price;
    }
}

$BTW_price = round($sub_total * 0.21, 2);
$total_price = $sub_total + $BTW_price;
?>
<html lang="en">
    <head>
        <title>Domein Zoeker - Checkout</title>
        <link href="../stylesheets/common.css" rel="stylesheet">
        <link href="../stylesheets/checkout.css" rel="stylesheet">
    </head>
    <body>
    <div class="container-default">
        <h1>Domein zoeker Checkout</h1>
        <h2>Wilt u de onderstaande domeinen bestellen?</h2>
        <h3>Niet beschikbare domeinen worden niet meeberekend binnen de totale prijs.</h3>
        <p style="margin-bottom: 10px">Om meer domeinen toe te voegen om te bestellen kunt u de knop hieronder indrukken om naar de vorige pagina terug te gaan. (opgezochte domeinen zullen blijven.)</p>
        <a class="knop-default" href="../index.php">Terug naar zoekpagina</a>
    </div>

        <div class="container-default selected-domains" id="domein-container">
        <div class="selected-domains-start selected-domains-row">
            <p>Naam</p><p>Beschikbaarheid</p><p>Prijs</p>
        </div>
            <?php
                foreach ($domain_data as $domain) {
                    $domain_name = $domain->domain;
                    $domain_status = $domain->status === "free" ? "Domein is beschikbaar" : $domain->status;
                    $domain_kleur = $domain->status === "free" ? "green" : "gray";
                    $domain_price = $domain->price->product->price;
                    $domain_currency = $domain->price->product->currency;
                    echo '<div class="selected-domains-row">
                            <p>'. $domain_name .'</p>
                            <p style="color: '. $domain_kleur .'">'. $domain_status .'</span>
                            <p>'. $domain_price . $domain_currency . '</p>
                            <form name="verwijder-domein" action="../functions/php/RemoveDomain.php" method="post" enctype="application/x-www-form-urlencoded">
                                <input type="hidden" id="domein-naam" name="domein-naam" value="' . $domain_name .'">
                                <input class="knop-default" type="submit" id="verwijder-domein" name="verwijder-domein" value="Verwijder domein">
                            </form>
                          </div>';
                }
            ?>
        </div>
        <div class="container-default">
            <p>Totaal excl. BTW: <?php echo $sub_total; ?></p>
            <p>21% BTW: <?php echo $BTW_price; ?></p>
            <p>Totaal incl. BTW: <?php echo $total_price; ?> EUR</p>
        </div>
        <form class="container-default form-layout" name="domein-zoek-formulier" action="../functions/php/PurchaseDomains.php" method="post" enctype="application/x-www-form-urlencoded">
            <label for="voornaam">Voornaam*:
                <input type="text" name="voornaam" id="voornaam" required>
            </label>
            <label for="tussenvoegsel">Tussenvoegsel:
                <input type="text" name="tussenvoegsel" id="tussenvoegsel">
            </label>
            <label for="achternaam">Achternaam*:
                <input type="text" name="achternaam" id="achternaam" required>
            </label>
            <input type="hidden" name="bestelde-domeinen" id="bestelde-domeinen" value='<?php echo json_encode($domain_data)?>'>
            <input class="knop-default" type="submit" name="domein-bestelknop" id="domein-bestelknop" value='Bestel domeinen'>
        </form>
    </body>
</html>
