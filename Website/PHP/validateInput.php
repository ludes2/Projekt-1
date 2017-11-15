<?php
/**
 * Created by PhpStorm.
 * User: kielm1
 * Date: 13.11.2017
 * Time: 11:01
 */

include_once "db.php";


    $db = db::getInstance();


    $data = $_POST['jsonDuration'];

    echo $data;


    /*$stmt = $db->prepare("INSERT INTO projekt1.durations (created_at, durations, dur_id, user_id) VALUES('13.11.2017', '$data', '34', '1')");
    $stmt->execute();
    */
