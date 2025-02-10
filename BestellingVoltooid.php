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
    <link href="" rel="stylesheet">
</head>
<body>
<h1>Bedankt voor het bestellen van de domeinen!</h1>
<h2>Hieronder staan de bestelde domeinen:</h2>
<div id="domein-container">
    <div class="">
        <p>Domein naam</p><p>Prijs</p>
    </div>
    <?php
    foreach ($domain_data as $domain) {
        $domain_name = $domain->name;
        $domain_price = $domain->price;
        $domain_currency = $domain->currency;
        echo '<div>
                <p>'. $domain_name .'</p>
                <p>'. $domain_price . $domain_currency .'</p>
              </div>';
    }
    ?>
</div>
<div>
    <p>Totaal excl. BTW: <?php echo $sub_total; ?></p>
    <p>21% BTW: <?php echo $BTW_price; ?></p>
    <p>Totaal incl. BTW: <?php echo $bestelling_data['prijs']; ?> EUR</p>
</div>
</body>
</html>
