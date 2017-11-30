<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 30.11.2017
 * Time: 15:40
 */

include_once "../controllers/duration_controller.php";
include_once "../PHP/db.php";

    $test = new duration_controller();

    if (isset($_POST['jsonDuration'])) {
        $json = $_POST['jsonDuration'];

        $test->saveDurationInDB($json);
        $test->compareDuration($json);
    }

