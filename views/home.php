<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Benutzer-Profiling</title>
</head>
<body>
<h1>Home UserInputs</h1>
<?php

session_start();

include_once "../models/duration.php";
include_once "../models/interval.php";
include_once "../models/latency.php";
include_once "../models/averages.php";

include_once "../views/duration_view.php";
include_once "../views/interval_view.php";
include_once "../views/latency_view.php";
include_once "../views/averages_view.php";

include_once "../controllers/duration_controller.php";
include_once "../controllers/interval_controller.php";
include_once "../controllers/latency_controller.php";

echo "<b>Last five durations: </b>" . "<br>";

$durationModel = new duration();
$durationView = new duration_view($durationModel);
$userID = $_SESSION['userID'];
$durationView->showLastFiveDurations($userID);
echo "<br>";


echo "<b>Duration averages: </b>" . "<br>";
$averageModel = new averages();
$durationView = new averages_view($averageModel);
$userID = $_SESSION['userID'];
$durationView->showDurationAverages($userID);
echo "<br>";
echo "<br>";

echo "<b>E-Mail: </b>" . ($_SESSION['userMail']) . "<br>";
echo "<br>";
echo "<b>UserID: </b>" . ($_SESSION['userID']) . "<br>";
echo "<br>";


echo "<b>Accuracy Duration: </b>";
$durationController = new duration_controller();
$durationController->compareDuration();
$durationController->getDurationPercent();
echo "<br>";

echo "<b>Accuracy Interval: </b>";
$intervalController = new interval_controller();
$intervalController->compareInterval();
$intervalController->getIntervalPercent();
echo "<br>";

echo "<b>Accuracy Latency: </b>";
$latencyController = new latency_controller();
$latencyController->compareLatency();
$latencyController->getLatencyPercent();
echo "<br>";

var_dump($durationController->getSumDurationID());


?>

</body>
</html>