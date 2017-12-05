<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include "../models/duration.php";
include_once "../PHP/db.php";

class duration_controller {

    private $durationModel;

    /**
     * duration_controller constructor.
     * @param duration $durationModel
     */


    function __construct(duration $durationModel) {
        $this->durationModel = $durationModel;

    }


    public function saveDurationInDB($duration) {

        $this->durationModel->insert($duration, '5', '6');
    }


    public function compareDuration($jsonDuration) {

        $durationDB = $this->durationModel->getDurationById('2');
        var_dump($durationDB);


        $getJSON = array();
        $getJSON[] = json_decode($jsonDuration['durations'], true);
        var_dump($getJSON);



        //$limit = 30;
        //$percentDuration = array();

        /*
        for ($i = 0; $i < sizeof($getDuration); $i++) {

            if (abs($getDuration[$i] - $saveDuration[$i]) > $limit) {
                return false;
            }

            /* Werte in % umwandeln
            if ($getDuration[$i] > $saveDuration[$i]) {
                $percentDuration[$i] = (($saveDuration[$i] * 100) / $getDuration[$i]);
            }

            if ($getDuration[$i] < $saveDuration[$i]) {
                $percentDuration[$i] = (($getDuration[$i] * 100) / $saveDuration[$i]);
            }
        }*/
    }
}

