<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 30.11.2017
 * Time: 15:40
 */

include_once "../controllers/duration_controller.php";
include_once "../PHP/db.php";

    $duration = new duration();

    $d_controller = new duration_controller($duration);

    global $json;



    if (isset($_POST['jsonDuration'])) {
        $json = $_POST['jsonDuration'];
    }

    $d_controller->saveDurationInDB($json); //var_dump geht nicht in if statement

/*
    if ($d_controller->compareDuration() == true) {
        echo "True";
    } else {
        echo "False";
    } */

