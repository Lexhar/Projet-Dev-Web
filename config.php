<?php

function getJsonData() {
    $jsonString = file_get_contents('data_base.json');
    $jsonData = json_decode($jsonString, true);
    return $jsonData;
}

function saveJsonData($data) {
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('data_base.json', $jsonString);
}

?>
