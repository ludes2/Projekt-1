<?php

include_once "../PHP/authentication.php";

$data = authenticate();
$authenticated = $data['authenticated'];
$userId = $data['userID'];

global $json;
var_dump(($data));

if ($authenticated){
    //$duration = new duration();
    $durationController = new duration_controller();
    $averagesController = new averages_controller();

    if (isset($_POST['jsonDuration'])) {
    $json = $_POST['jsonDuration'];
    $durationController->saveDurationInDB($json); //var_dump geht nicht in if statement
    //$averagesController->saveAveragesInDB();






}









}