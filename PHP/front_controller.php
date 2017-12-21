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


// If email and password correct go forward
if ($authenticated == true) {

    if (isset($_POST['jsonDuration']) && isset($_POST['jsonInterval']) && isset($_POST['jsonLatency'])) {

            $jsonDuration = $_POST['jsonDuration']; //Get the duration from AJAX
            $durationController->saveDurationInDB($jsonDuration);

            $jsonInterval = $_POST['jsonInterval']; //Get the interval from AJAX
            $intervalController->saveIntervalInDB($jsonInterval);

            $jsonLatency = $_POST['jsonLatency']; //Get the latency from AJAX
            $latencyController->saveLatencyInDB($jsonLatency);


        //There must be at least 5 entries in the db to calculate and store the averages
        if (($durationController->getSumDurationID()) > 4) {

                $durationAverage = $durationController->getDurationAverage();
                $intervalAverage = $intervalController->getIntervalAverage();
                $latencyAverage = $latencyController->getLatencyAverage();

                $averagesController->saveAveragesInDB($intervalAverage, $latencyAverage, $durationAverage);
        }
    }

    //The comparison works not until there is a db entry for averages
    if (($durationController->getSumDurationID()) > 4) {

        if ($durationController->compareDuration() == true && $intervalController->compareInterval() == true &&
            $latencyController->compareLatency() == true) {
            //If comparison successful go to home.php
            header('location: http://localhost:63342/Projekt-1/views/home.php');
        } else {
            echo "False Compare";
        }
    }
    else {
        echo "Not 5 Entries";
    }
}