<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php

session_start();

include_once "../models/duration.php";
include "../views/duration_view.php";
include_once "../models/averages.php";
include_once "../views/averages_view.php";
$durationModel = new duration();
$durationView = new duration_view($durationModel);
$durationView->showLastFiveDurations(5);
echo "<br/>";
echo "<br/>";
$averageModel = new averages();
$durationView = new averages_view($averageModel);
$durationView->showDurationAverages(5);

//$durationModel->insert(['1', '2', '3', '4', '5', '6'], 1);

echo $_SESSION['user'];

var_dump($_SESSION['userID']);







?>

<h1>Home</h1>
<h2>on this page we can show the results of the userinputs</h2> <br/>





</body>
</html>