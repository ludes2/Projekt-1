<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php session_start(); ?>
    <title>User Profiling</title>
    <link rel='stylesheet' href='../CSS/home.css'/>
</head>
<body>
<h1>Home UserInputs</h1>
<?php



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

$durationModel = new duration();
$durationView = new duration_view($durationModel);
$intervalModel = new interval();
$intervalView = new interval_view($intervalModel);
$latencyModel = new latency();
$latencyView = new latency_view($latencyModel);
$averageModel = new averages();
$averageView = new averages_view($averageModel);


echo "<b>E-Mail: </b>" . ($_SESSION['email']) . "<br>";
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
echo "<br>";
echo "<br>";


echo "<b>Last five durations: </b>" . "<br>";
$userID = $_SESSION['userID'];
$durationView->showLastFiveDurations($userID);
echo "<br>";

echo "<b>Duration averages: </b>" . "<br>";
$userID = $_SESSION['userID'];
$averageView->showLastFiveDurationAverages($userID);
echo "<br>";
echo "<br>";


echo "<b>Last five intervals: </b>" . "<br>";
$userID = $_SESSION['userID'];
$intervalView->showLastFiveIntervals($userID);
echo "<br>";

echo "<b>Interval averages: </b>" . "<br>";
$userID = $_SESSION['userID'];
$averageView->showLastFiveIntervalAverages($userID);
echo "<br>";
echo "<br>";


echo "<b>Last five latencies: </b>" . "<br>";
$userID = $_SESSION['userID'];
$latencyView->showLastFiveLatencies($userID);
echo "<br>";

echo "<b>Latency averages: </b>" . "<br>";
$userID = $_SESSION['userID'];
$averageView->showLastFiveLatencyAverages($userID);
echo "<br>";
echo "<br>";

?>

</body>
</html>