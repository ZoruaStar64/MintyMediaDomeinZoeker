<?php
session_start();
if ($_POST['domein-bestelknop']) {
    require_once 'database.php';
    global $pdo;
    require_once 'Domein_Manager.php';

    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = null;
    if (isset($_POST['tussenvoegsel'])) {
        $tussenvoegsel = $_POST['tussenvoegsel'] == null ? '' : $_POST['tussenvoegsel'];
    }
    $achternaam = $_POST['achternaam'];
    $bestelling = json_decode($_POST['bestelde-domeinen']);
    $domains = [];
    $total_price = 0;
    $sub_total = 0;
    $BTW_price = 0;

    /**
     * Hier worden domeinen die niet beschikbaar zijn weggehaald.
     */
    foreach ($bestelling as $domain => $value) {
        if ($value['status'] != "free") {
            unset($bestelling[$domain]);
        }
    }

    foreach ($bestelling as $domain) {
        if ($domain->status == "free") {
            $domains[] = ["name" => $domain->domain, "price" => $domain->price->product->price, "currency" => $domain->price->product->currency];
            $sub_total += $domain->price->product->price;
        }
    }

    $BTW_price = round($sub_total * 0.21, 2);
    $total_price = $sub_total + $BTW_price;
    create_bestelling($voornaam, $tussenvoegsel, $achternaam, json_encode($domains), $total_price);
    $_SESSION['bestelling-id'] = get_max_id_bestelling();

    header("Location: BestellingVoltooid.php");
}
