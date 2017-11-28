<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
include "../models/duration.php";
include "../models/averages.php";
$duration = duration::getDurationById(3);
var_dump($duration);
$res = implode(',', $duration);
echo "<br>";
echo "<br>";
echo "durations by id 3: " . $res;

echo "<br>";
echo "<br>";
echo "<br>";
$duration = new duration();
$lastFive = $duration->getLastFiveDurationsOfUser(5);

echo "last 5 durations uf user with ID 5: ";
echo "<br>";
foreach ($lastFive as $key => $value){
    echo "duration index: " . $key . "= ";
    for($x=0 ; $x<count($value); $x++){
        echo $value[$x] . ", ";
    }
    echo "<br>";
}
echo "<br>";
echo "<br>";

$averages = $duration->calculateAverage(5);
var_dump($averages);














 ?>


</body>
</html>