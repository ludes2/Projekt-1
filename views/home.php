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
include "../views/duration_view.php";
include_once "../models/averages.php";
include_once "../views/averages_view.php";
include_once "../controllers/duration_controller.php";

echo "<b>Last five durations: </b>" . "<br>";



$durationModel = new duration();
$durationView = new duration_view($durationModel);
$durationView->showLastFiveDurations(6);
echo "<br>";


echo "<b>Duration averages: </b>" . "<br>";
$averageModel = new averages();
$durationView = new averages_view($averageModel);
$durationView->showDurationAverages(5);
echo "<br>";
echo "<br>";

echo "<b>E-Mail: </b>" . $_SESSION['userMail'] . "<br>";
echo "<br>";
echo "<b>UserID: </b>" . ($_SESSION['userID']) . "<br>";
echo "<br>";


echo "<b>Accuracy Duration: </b>";
$durationController = new duration_controller();
$durationController->compareDuration();
$durationController->getDurationPercent();
?>

</body>
</html>