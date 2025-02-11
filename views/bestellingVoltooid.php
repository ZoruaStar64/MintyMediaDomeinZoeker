<?php
session_start();
require_once('Domein_Manager.php');

$bestelling_data = get_bestelling_by_id($_SESSION['bestelling-id']);
$domain_data = json_decode($bestelling_data['domeinen']);
$sub_total = 0;
$BTW_price = 0;
foreach ($domain_data as $domain) {
    $sub_total += $domain->price;
}
$BTW_price = round($sub_total * 0.21, 2);
?>
<html lang="en">
<head>
    <title>Domein Zoeker - Bestelling voltooid</title>
    <link href="../stylesheets/common.css" rel="stylesheet">
    <link href="../stylesheets/checkout.css" rel="stylesheet">
    <link href="../stylesheets/bestellingVoltooid.css" rel="stylesheet">
</head>
<body>
<div class="container-default">
    <h1>Bedankt voor het bestellen van het/de domein(en)!</h1>
    <h2>Hieronder staan uw bestelde domeinen:</h2>
</div>
<div class="container-default selected-domains" id="domein-container">
    <div class="selected-domains-start selected-domains-row">
        <p>Domein naam</p><p>Prijs</p>
    </div>
    <?php
    foreach ($domain_data as $domain) {
        $domain_name = $domain->name;
        $domain_price = $domain->price;
        $domain_currency = $domain->currency;
        echo '<div class="selected-domains-row">
                <p>'. $domain_name .'</p>
                <p>'. $domain_price . $domain_currency .'</p>
              </div>';
    }
    ?>
</div>
<div class="container-default">
    <p>Totaal excl. BTW: <?php echo $sub_total; ?></p>
    <p>21% BTW: <?php echo $BTW_price; ?></p>
    <p>Totaal incl. BTW: <?php echo $bestelling_data['prijs']; ?> EUR</p>
</div>
</body>
</html>
