<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include "../models/duration.php";

class duration_controller {

    private $durationModel;

    /**
     * duration_controller constructor.
     * @param duration $durationModel
     */
    function __construct(duration $durationModel) {
        $this->durationModel = $durationModel;
    }

    public function saveDurationToDB() {

        if (isset($_POST['jsonDuration'])) {
            $duration = $_POST['jsonDuration'];

            duration::insert($duration);

        }
    }
}

