<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include "../models/duration.php";
include_once "../PHP/db.php";

session_start();

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


        $userID = $_SESSION['userID']; // ????????????
        $this->durationModel->insert($duration, $userID);
//        var_dump($_SESSION['userID']);

        //$this->durationModel->insert($duration, '5');
    }



    public function compareDuration()
    {

        $durationDB1 = $this->durationModel->getDurationById('1'); //Hier Average Wert

        $durationDB2 = $this->durationModel->getDurationById('3'); //Hier gleiche ID wie bei insert


        $limit = 30;
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
        $result = ($sum / sizeof($percentDuration));
        return print_r($sum);
    }
}
