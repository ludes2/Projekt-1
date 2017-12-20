<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

require_once "../models/duration.php";
require_once "../models/averages.php";
//require_once "../PHP/db.php";

class duration_controller
{



    private $durationModel;
    private $averageModel;


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
        $this->averageModel = new averages();
    }


    public function getDurationModel()
    {
        return $this->durationModel;
    }

    public function getDurationAverage()
    {
        $userID = $_SESSION['userID'];
        $jsonDurationAverage = json_encode($this->durationModel->calculateAverage($userID));
        return $jsonDurationAverage;
    }



    public function saveDurationInDB($duration)
    {
        session_start();
        $userID = $_SESSION['userID'];
        $this->durationModel->insert($duration, $userID);
    }


    public function getSumDurationID() {
        return $this->durationModel->sumDurationID();
    }

    public function compareDuration()
    {

        $lastID = $this->durationModel->getLastDurationID();
        $lastAverage = $this->averageModel->getLastAverageID();

        $durationDB1 = $this->averageModel->getDurationAveragesById($lastAverage);
        $durationDB2 = $this->durationModel->getDurationById($lastID); //Hier Last ID


        $limit = 100;
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
