<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include_once "../models/duration.php";
include_once "../PHP/db.php";

class duration_controller
{



    private $durationModel;


    /**
     * duration_controller constructor.
     * @param duration $durationModel
     */


    function __construct(duration $durationModel)
    {
        $this->durationModel = $durationModel;
    }



    public function saveDurationInDB($duration)
    {

        $userID = $_SESSION['userID'];
        $this->durationModel->insert($duration, $userID);
    }

    public function saveDurationAverage() {

        $userID = $_SESSION['userID'];
        $this->durationModel->calculateAverage($userID);
    }



    public function compareDuration()
    {
        $lastID = $this->durationModel->getLastDurationID();

        $durationDB1 = $this->durationModel->getDurationById('5'); //Hier Average Wert
        $durationDB2 = $this->durationModel->getDurationById('6'); //Hier gleiche ID wie bei insert


        $limit = 50;
        $percentDuration = array();


        for ($i = 0; $i < sizeof($durationDB1); $i++) {

            if (abs($durationDB2[$i] - $durationDB1[$i]) > $limit) {
                return false;
            }

            /* Werte in % umwandeln */
            if ($durationDB2[$i] > $durationDB1[$i]) {
                $percentDuration[$i] = (($durationDB1[$i] * 100) / $durationDB2[$i]);
            }

            if ($durationDB2[$i] < $durationDB1[$i]) {
                $percentDuration[$i] = (($durationDB2[$i] * 100) / $durationDB1[$i]);
            }
        }

        /* Summe von Array / Länge des Arrays, Gesamt % von Duration */
        $sum = array_sum($percentDuration);
        global $result;
        $result = (round($sum / sizeof($percentDuration)));
        return true;
    }

    public function getPercent() {
        global $result;
        print_r($result . "%");
    }
}
