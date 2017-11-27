<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
include "../models/duration.php";
$duration = duration::getDurationById(3);
var_dump($duration);
$res = implode(',', $duration);
echo "<br>";
echo "<br>";
echo "durations by id 3: " . $res;

echo "<br>";
echo "<br>";
echo "<br>";

$lastFive = duration::getLastFiveDurationsOfUser(5);

foreach ($lastFive as $value){
    echo "durations: ";
    for($x=0; $x<count($value); $x++){
        echo $value[$x] . ", ";
    }
    echo "<br>";
}
echo "<br>";
echo "<br>";









 ?>


</body>
</html>