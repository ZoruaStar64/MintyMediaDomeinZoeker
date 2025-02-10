<?php
require_once 'database.php';

function create_bestelling($voornaam, $tussenvoegsel, $achternaam, $bestelling, $total_price) {
    global $pdo;
    $domeinBestellingInsertion =
        "INSERT INTO mintydomeinzoeker.bestellingen 
            (voornaam, tussenvoegsels, achternaam, domeinen, prijs, muntsoort) 
            VALUES (?,?,?,?,?,?)
        ";
    $stmt = $pdo->prepare($domeinBestellingInsertion);
    $stmt->bindValue(1, $voornaam);
    $stmt->bindValue(2, $tussenvoegsel);
    $stmt->bindValue(3, $achternaam);
    $stmt->bindValue(4, $bestelling);
    $stmt->bindValue(5, $total_price);
    $stmt->bindValue(6, "Euro");
    $stmt->execute();
}
function get_max_id_bestelling() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT MAX(id) AS maxId
        FROM mintydomeinzoeker.bestellingen ;");
    $stmt->execute();

    $maxIdBestelling = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $maxIdBestelling["maxId"];
    return $maxId;
}

function get_bestelling_by_id($id) {
    global $pdo;
    $domeinBestellingSelection = "SELECT * FROM mintydomeinzoeker.bestellingen WHERE id = ?";
    $stmt = $pdo->prepare($domeinBestellingSelection);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    $bestelling = $stmt->fetch();
    return $bestelling;
}
