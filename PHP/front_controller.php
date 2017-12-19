<?php

include_once "../PHP/authentication.php";
include_once "../controllers/duration_controller.php";
include_once "../controllers/interval_controller.php";
include_once "../controllers/latency_controller.php";
include_once "../controllers/averages_controller.php";

$data = authenticate();
$authenticated = $data['authenticated'];
$userId = $data['userID'];
var_dump(($data));

//global $json;


if ($authenticated == true) {
    //$duration = new duration();

    //$averagesController = new averages_controller();
}

$durationController = new duration_controller();
$intervalController = new interval_controller();
$latencyController = new latency_controller();
$averagesController = new averages_controller();

if ($durationController->compareDuration() == true) {


    if (isset($_POST['jsonDuration'])) {

        $jsonDuration = $_POST['jsonDuration'];
        $durationController->saveDurationInDB($jsonDuration); //var_dump geht nicht in if statement

        if (($durationController->getSumDurationID()) > 5) { //Geit noni...obwou print_r zrichtige usgit

            $durationAverage = $durationController->getDurationAverage();
            $intervalAverage = $intervalController->getIntervalAverage();
            $latencyAverage = $latencyController->getLatencyAverage();

            $averagesController->saveAveragesInDB($intervalAverage, $latencyAverage, $durationAverage);
        }
    }


    if (isset($_POST['jsonInterval'])) {
        $jsonInterval = $_POST['jsonInterval'];
        $intervalController->saveIntervalInDB($jsonInterval); //var_dump geht nicht in if statement

    }

    if (isset($_POST['jsonLatency'])) {
        $jsonLatency = $_POST['jsonLatency'];
        $latencyController->saveLatencyInDB($jsonLatency); //var_dump geht nicht in if statement

    }
}







