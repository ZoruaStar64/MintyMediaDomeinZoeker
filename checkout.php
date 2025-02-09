<?php
session_start();
$domain_data = json_decode($_SESSION['domain_data']);
$total_price = 0;
foreach ($domain_data as $domain) {
    if ($domain->status == "free") {
        $total_price += $domain->price->product->price;
    }
}
?>
<html lang="en">
    <head>
        <title>Domein Zoeker - Checkout</title>
        <link href="" rel="stylesheet">
    </head>
    <body>
    <h1>Domein zoeker Checkout</h1>
    <h2>Wilt u de onderstaande domeinen bestellen?</h2>
    <h3>Niet beschikbare domeinen worden niet meeberekend binnen de totale prijs.</h3>
        <div id="domein-container">
        <div class="">
            <p>Domein naam</p><p>Beschikbaarheid</p><p>Prijs</p>
        </div>
            <?php
                foreach ($domain_data as $domain) {
                    $domain_name = $domain->domain;
                    $domain_status = $domain->status === "free" ? "Domein is beschikbaar" : $domain->status;
                    $domain_price = $domain->price->product->price;
                    $domain_currency = $domain->price->product->currency;
                    echo '<div>
                            <p>'. $domain_name .'</p>
                            <p>'. $domain_status .'</span>
                            <p>'. $domain_price . $domain_currency .'</p>
                          </div>';
                }
            ?>
        </div>
        <div><p>Totale kost: <?php echo $total_price; ?> EUR</p></div>
        <form name="domein-zoek-formulier" action="PurchaseDomains.php" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="geselecteerde-domeinen" id="geselecteerde-domeinen" value="hi">
            <input type="submit" name="domein-bestelknop" id="domein-bestelknop" value="Bestel domeinen">
        </form>
    </body>
</html>
