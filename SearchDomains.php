<?php
session_start();
if ($_POST['domein-zoekknop']) {
    $jsonifiedDomains = $_POST['geselecteerde-domeinen'];
    $auth = require_once 'auth.php';
    $response2 = curl_init();
    curl_setopt($response2, CURLOPT_URL, 'https://dev.api.mintycloud.nl/api/v2.1/domains/search?with_price=true');
    curl_setopt($response2, CURLOPT_POST, 1);
    curl_setopt($response2, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: '. $auth]);
    curl_setopt($response2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($response2, CURLOPT_POSTFIELDS, $jsonifiedDomains);

    $data = curl_exec($response2);
    curl_close($response2);
    var_dump($data);
    if ($data) {
        $_SESSION['domain_data'] = $data;
        header('Location: checkout.php');
    } else {
        $_SESSION['domain_data'] = $jsonifiedDomains;
        header('Location: index.php');
    }
}