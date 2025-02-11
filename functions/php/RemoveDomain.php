<?php
session_start();
if ($_POST['verwijder-domein']) {
    $bestelling = json_decode($_SESSION['domain_data'], true);
    $deletedDomain = $_POST['domein-naam'];

    foreach ($bestelling as $domain => $value) {
        if ($value['status'] !== "free" || $value['domain'] === $deletedDomain) {
            unset($bestelling[$domain]);
        }
    }
    $_SESSION['domain_data'] = json_encode($bestelling);

    header("Location: ../../views/checkout.php");
}
