<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 12.12.2017
 * Time: 09:41
 */

require_once "../models/latency.php";
require_once "../models/averages.php";

class latency_controller {

    private $latencyModel;
    private $averageModel;


    function __construct() {

        $this->latencyModel = new latency();
        $this->averageModel = new averages();
    }


    public function getLatencyModel() {

        return $this->latencyModel;
    }


    public function getLatencyAverage() {

        $userID = $_SESSION['userID'];
        $jsonLatencyAverage = json_encode($this->latencyModel->calculateAverage($userID));
        return $jsonLatencyAverage;
    }


    public function saveLatencyInDB($latency) {


        $userID = $_SESSION['userID'];
        $this->latencyModel->insert($latency, $userID);
    }


    public function saveLatencyAverage() {

        $userID = $_SESSION['userID'];
        $this->latencyModel->calculateAverage($userID);
    }


    /**
    Compare the latency between the values that the user just entered and the last average latency from the DB
     * the limit is 100ms. So if the difference is bigger than 100 -> false
     **/
    public function compareLatency() {

        $lastID = $this->latencyModel->getLastLatencyID();
        $lastAverage = $this->averageModel->getLastAverageID();

        $latencyDB1 = $this->averageModel->getLatencyAveragesById($lastAverage);
        $latencyDB2 = $this->latencyModel->getLatencyById($lastID);


        $limit = 100;
        $percentLatency = array();


        for ($i = 1; $i < sizeof($latencyDB1); $i++) {

            if (abs($latencyDB2[$i] - $latencyDB1[$i]) > $limit) {
                return false;
            }

            // Convert values to %
            if ($latencyDB2[$i] > $latencyDB1[$i]) {
                $percentLatency[$i] = (($latencyDB1[$i] * 100) / $latencyDB2[$i]);
            }

            if ($latencyDB2[$i] < $latencyDB1[$i]) {
                $percentLatency[$i] = (($latencyDB2[$i] * 100) / $latencyDB1[$i]);
            }
        }

        // Calculate the result in %
        $sum = array_sum($percentLatency);
        global $result;
        $result = (round($sum / sizeof($percentLatency)));
        return true;
    }

    /**
    Print the result from the comparison in %
     **/
    public function getLatencyPercent() {
        global $result;
        print_r($result . "%");
    }
}