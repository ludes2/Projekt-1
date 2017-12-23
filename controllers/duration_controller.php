<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

require_once "../models/duration.php";
require_once "../models/averages.php";

class duration_controller {

    private $durationModel;
    private $averageModel;

    function __construct() {

        $this->durationModel = new duration();
        $this->averageModel = new averages();
    }


    public function getDurationModel() {

        return $this->durationModel;
    }


    /**
     * @return string
     */
    public function getDurationAverage() {

        $userID = $_SESSION['userID'];
        $jsonDurationAverage = json_encode($this->durationModel->calculateAverage($userID));
        return $jsonDurationAverage;
    }


    /**
     * saves the new duration in the database
     * @param $duration
     */
    public function saveDurationInDB($duration) {

        $userID = $_SESSION['userID'];
        $this->durationModel->insert($duration, $userID);
    }


    /**
     Count how many duration entries are in the DB
     **/
    public function getSumDurationID() {

        return $this->durationModel->sumDurationID();
    }


    /**
    Compare the duration between the values that the user just entered and the last average duration from the DB
     * the limit is 100ms. So if the difference is bigger than 100 -> false
     **/
    public function compareDuration() {

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

            // Convert values to %
            if ($durationDB2[$i] > $durationDB1[$i]) {
                $percentDuration[$i] = (($durationDB1[$i] * 100) / $durationDB2[$i]);
            }

            if ($durationDB2[$i] < $durationDB1[$i]) {
                $percentDuration[$i] = (($durationDB2[$i] * 100) / $durationDB1[$i]);
            }
        }

        // Calculate the result in %
        $sum = array_sum($percentDuration);
        global $result;
        $result = (round($sum / sizeof($percentDuration)));
        return true;
    }


    /**
    Print the result from the comparison in %
     **/
    public function getDurationPercent() {
        global $result;
        print_r($result . "%");
    }
}
