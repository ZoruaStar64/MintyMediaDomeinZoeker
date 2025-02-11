<?php
session_start();
if ($_POST['domein-zoekknop']) {
    $jsonifiedDomains = $_POST['geselecteerde-domeinen'];
    if (isset($_SESSION['domain_data'])) {
        $bestelling = json_decode($_SESSION['domain_data'], true);
        $deJsonifiedDomains = json_decode($jsonifiedDomains, true);

        foreach ($bestelling as $domain => $value) {
            foreach ($deJsonifiedDomains as $deJsonifiedDomain => $searchedValue) {
                $fullDomainName = $searchedValue['name'] . '.' . $searchedValue['extension'];
                if ($value['domain'] === $fullDomainName) {
                    unset($deJsonifiedDomains[$deJsonifiedDomain]);
                }
            }
        }
        //array_merge wordt hier gebruik zodat de decoded array niet als associative teruggegeven wordt.
        $jsonifiedDomains = json_encode(array_merge($deJsonifiedDomains));
    }

    $auth = require_once 'auth.php';
    $response2 = curl_init();
    curl_setopt($response2, CURLOPT_URL, 'https://dev.api.mintycloud.nl/api/v2.1/domains/search?with_price=true');
    curl_setopt($response2, CURLOPT_POST, 1);
    curl_setopt($response2, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: '. $auth]);
    curl_setopt($response2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($response2, CURLOPT_POSTFIELDS, $jsonifiedDomains);

    $data = curl_exec($response2);
    curl_close($response2);

    if ($data) {
        if (isset($_SESSION['domain_data'])) {
            $data = json_encode(
                array_merge(
                    json_decode($data, true),
                    json_decode($_SESSION['domain_data'], true)
                )
            );
        }
        $_SESSION['domain_data'] = $data;
        header('Location: checkout.php');
    } else {
        $_SESSION['domain_data'] = $jsonifiedDomains;
        header('Location: index.php');
    }
}