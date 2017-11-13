<?php
/**
 * Created by PhpStorm.
 * User: kielm1
 * Date: 13.11.2017
 * Time: 11:01
 */

include_once "db.php";


    $db = db::getInstance();


    /*$array=json_decode($_POST['jsonDuration']);*/


    $stmt = $db->prepare("INSERT INTO projekt1.durations (created_at, durations, dur_id, user_id) VALUES('13.11.2017', 'test', '1', '1')");
    $stmt->execute();
