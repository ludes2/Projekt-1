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

    /* save duration from JavaScript in DB
    if(isset($_POST['jsonDuration']))
    {
    $duration = $_POST['jsonDuration'];

        $stmt = $db->prepare("INSERT INTO projekt1.durations (created_at, durations, dur_id, user_id) VALUES('13.11.2017', '$duration', '1', '1')");
        $stmt->execute();
    }

    if(isset($_POST['jsonLatency']))
    {
    $latency = $_POST['jsonLatency'];

        $stmt = $db->prepare("INSERT INTO projekt1.latencies (created_at, latencies, lat_id, user_id) VALUES('13.11.2017', '$latency', '1', '1')");
        $stmt->execute();
    }

    if(isset($_POST['jsonInterval']))
    {
    $interval = $_POST['jsonInterval'];

        $stmt = $db->prepare("INSERT INTO projekt1.intervals (created_at, intervals, interval_id, user_id) VALUES('13.11.2017', '$interval', '1', '1')");
        $stmt->execute();
    } */

    /* -------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* get values from database */
    if (!$error) {
    $testDuration = $db->query("SELECT durations FROM projekt1.durations WHERE dur_id = '1';");
    $row = $testDuration->fetch_assoc();
    $resultDuration = json_encode($row);
    echo $row["durations"];
}







