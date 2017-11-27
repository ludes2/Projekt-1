<?php
/**
 * Created by PhpStorm.
 * User: kielm1
 * Date: 13.11.2017
 * Time: 11:01
 */

include_once "db.php";


    $db = db::getInstance();

    $error = false;

    /* ---------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* save duration from JavaScript in DB (only 5 entries)*/

    $result = $db->query("SELECT projekt1.durations.dur_id FROM projekt1.durations order by dur_id DESC;");
    $row = $result->fetch_assoc();
    $idCounter = $row["dur_id"];

    if ($idCounter <= 4) {

        if (isset($_POST['jsonDuration'])) {
            $duration = $_POST['jsonDuration'];

            $stmt = $db->prepare("INSERT INTO projekt1.durations (durations, dur_id, user_id) VALUES('$duration', $idCounter + 1, '1')");
            $stmt->execute();
        }
    }

    if ($idCounter <= 5)    {

        if (isset($_POST['jsonLatency'])) {
            $latency = $_POST['jsonLatency'];

            $stmt = $db->prepare("INSERT INTO projekt1.latencies (latencies, lat_id, user_id) VALUES('$latency', $idCounter, '1')");
            $stmt->execute();
        }

        if (isset($_POST['jsonInterval'])) {
            $interval = $_POST['jsonInterval'];

            $stmt = $db->prepare("INSERT INTO projekt1.intervals (intervals, interval_id, user_id) VALUES('$interval', $idCounter, '1')");
            $stmt->execute();
        }
    }

    echo "5 Einträge erreicht";

    /* -------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* get values from database */
    if (!$error) {
        $testDuration = $db->query("SELECT durations FROM projekt1.durations WHERE dur_id = '2';");
        $row = $testDuration->fetch_assoc();
        $resultDuration = json_encode($row);
        echo $row["durations"];
    }








