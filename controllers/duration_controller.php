<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

require_once "../models/duration.php";
require_once "../PHP/db.php";

class duration_controller
{



    private $durationModel;


//    /**
//     * duration_controller constructor.
//     * @param duration $durationModel
//     */
//    function __construct(duration $durationModel)
//    {
//        $this->durationModel = $durationModel;
//    }


    function __construct()
    {
        $this->durationModel = new duration();
    }


    public function getDurationModel()
    {
        return $this->durationModel;
    }



    public function saveDurationInDB($duration)
    {

        $userID = $_SESSION['userID'];
        $this->durationModel->insert($duration, $userID);
    }




    /**
     * wandelt den Wert von compareDuration in % um
     */
    public function calculatePercent()
{
}


    public function saveDurationAverage() {

        $userID = $_SESSION['userID'];
        $this->durationModel->calculateAverage($userID);

    }



    public function compareDuration()
    {
        $lastID = $this->durationModel->getLastDurationID();

        $durationDB1 = $this->durationModel->getDurationById('5'); //Hier Average Wert
        $durationDB2 = $this->durationModel->getDurationById('6'); //Hier Last ID


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

    public function getDurationPercent() {
        global $result;
        print_r($result . "%");
    }
}
