<?php
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
            <label for="domein_extensie">
                Typ hier uw gewenste domein extensie op (com, nl, enzovoort).
                <input type="text" id="domein-extensie" name="domein-extensie" required>
            </label>
            <button type="button" onclick="Add_Domain()">Voeg domein toe aan selectie</button>
        </form>
    <div id="domein_container"></div>
    </body>
<script src="HandleDomains.js" type="application/javascript"></script>
</html>
