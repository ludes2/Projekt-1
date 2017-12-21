<?php

include_once "../PHP/authentication.php";
include_once "../controllers/duration_controller.php";
include_once "../controllers/interval_controller.php";
include_once "../controllers/latency_controller.php";
include_once "../controllers/averages_controller.php";

$data = authenticate();
$authenticated = $data['authenticated'];

$durationController = new duration_controller();
$intervalController = new interval_controller();
$latencyController = new latency_controller();
$averagesController = new averages_controller();


if ($authenticated == true) {

    if (isset($_POST['jsonDuration']) && isset($_POST['jsonInterval']) && isset($_POST['jsonLatency'])) {

            $jsonDuration = $_POST['jsonDuration'];
            $durationController->saveDurationInDB($jsonDuration); //var_dump geht nicht in if statement

            $jsonInterval = $_POST['jsonInterval'];
            $intervalController->saveIntervalInDB($jsonInterval); //var_dump geht nicht in if statement

            $jsonLatency = $_POST['jsonLatency'];
            $latencyController->saveLatencyInDB($jsonLatency); //var_dump geht nicht in if


        if (($durationController->getSumDurationID()) > 4) { //Geit noni...obwou print_r zrichtige usgit

                $durationAverage = $durationController->getDurationAverage();
                $intervalAverage = $intervalController->getIntervalAverage();
                $latencyAverage = $latencyController->getLatencyAverage();

                $averagesController->saveAveragesInDB($intervalAverage, $latencyAverage, $durationAverage);
        }
    }


    if (($durationController->getSumDurationID()) > 4) {

        if ($durationController->compareDuration() == true && $intervalController->compareInterval() == true &&
            $latencyController->compareLatency() == true) {
            header('location: http://localhost:63342/Projekt-1/views/home.php');
        } else {
            echo "False Compare";
        }
    }
    else {
        echo "Not 5 Entries";
    }
}







