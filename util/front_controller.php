<?php

include_once "../PHP/authentication.php";
include_once "../controllers/duration_controller.php";
//include_once "../controllers/averages_controller.php";

$data = authenticate();
$authenticated = $data['authenticated'];
$userId = $data['userID'];
var_dump(($data));

global $json;


if ($authenticated == true) {
    //$duration = new duration();
    $durationController = new duration_controller();
    $averagesController = new averages_controller();
}

if (isset($_POST['jsonDuration'])) {
    $json = $_POST['jsonDuration'];
    $durationController->saveDurationInDB($json); //var_dump geht nicht in if statement
    //$averagesController->saveAveragesInDB();

}

