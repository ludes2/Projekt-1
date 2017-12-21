<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 12.12.2017
 * Time: 09:40
 */

require_once "../models/interval.php";
require_once "../models/averages.php";

class interval_controller {

    private $intervalModel;
    private $averageModel;


    function __construct() {

        $this->intervalModel = new interval();
        $this->averageModel = new averages();
    }


    public function getIntervalModel() {

        return $this->intervalModel;
    }

    public function getIntervalAverage() {

        $userID = $_SESSION['userID'];
        $jsonIntervalAverage = json_encode($this->intervalModel->calculateAverage($userID));
        return $jsonIntervalAverage;
    }


    public function saveIntervalInDB($interval) {

        $userID = $_SESSION['userID'];
        $this->intervalModel->insert($interval, $userID);
    }


    public function saveIntervalAverage() {

        $userID = $_SESSION['userID'];
        $this->intervalModel->calculateAverage($userID);
    }


    /**
    Compare the interval between the values that the user just entered and the last average interval from the DB
     * the limit is 100ms. So if the difference is bigger than 100 -> false
     **/
    public function compareInterval() {

        $lastID = $this->intervalModel->getLastIntervalID();
        $lastAverage = $this->averageModel->getLastAverageID();

        $intervalDB1 = $this->averageModel->getIntervalAveragesById($lastAverage);
        $intervalDB2 = $this->intervalModel->getIntervalById($lastID);


        $limit = 100;
        $percentInterval = array();


        for ($i = 1; $i < sizeof($intervalDB1); $i++) {

            if (abs($intervalDB2[$i]) - abs($intervalDB1[$i]) > $limit) {
                return false;
            }

            // Convert values to %
            if (abs($intervalDB2[$i]) > abs($intervalDB1[$i])) {
                $percentInterval[$i] = (abs($intervalDB1[$i]) * 100 / abs($intervalDB2[$i]));
            }

            if (abs($intervalDB2[$i]) < abs($intervalDB1[$i])) {
                $percentInterval[$i] = (abs($intervalDB2[$i]) * 100 / abs($intervalDB1[$i]));
            }
        }

        // Calculate the result in %
        $sum = array_sum($percentInterval);
        global $result;
        $result = (round($sum / sizeof($percentInterval)));
        return true;
    }


    /**
    Print the result from the comparison in %
     **/
    public function getIntervalPercent() {
        global $result;
        print_r($result . " %");
    }
}