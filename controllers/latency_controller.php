<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 12.12.2017
 * Time: 09:41
 */


require_once "../models/latency.php";
require_once "../models/averages.php";
//require_once "../PHP/db.php";

class latency_controller
{

    private $latencyModel;
    private $averageModel;


    function __construct()
    {
        $this->latencyModel = new latency();
        $this->averageModel = new averages();
    }


    public function getLatencyModel()
    {
        return $this->latencyModel;
    }


    public function getLatencyAverage()
    {
        $userID = $_SESSION['userID'];
        $jsonLatencyAverage = json_encode($this->latencyModel->calculateAverage($userID));
        return $jsonLatencyAverage;
    }


    public function saveLatencyInDB($latency)
    {

        session_start();
        $userID = $_SESSION['userID'];
        $this->latencyModel->insert($latency, $userID);
    }



    /**
     * wandelt den Wert von compareLatency in % um
     */
    public function calculatePercent()
    {
    }


    public function saveLatencyAverage() {

        $userID = $_SESSION['userID'];
        $this->latencyModel->calculateAverage($userID);

    }



    public function compareLatency()
    {
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

            /* Werte in % umwandeln */
            if ($latencyDB2[$i] > $latencyDB1[$i]) {
                $percentLatency[$i] = (($latencyDB1[$i] * 100) / $latencyDB2[$i]);
            }

            if ($latencyDB2[$i] < $latencyDB1[$i]) {
                $percentLatency[$i] = (($latencyDB2[$i] * 100) / $latencyDB1[$i]);
            }
        }

        /* Summe von Array / Länge des Arrays, Gesamt % von Duration */
        $sum = array_sum($percentLatency);
        global $result;
        $result = (round($sum / sizeof($percentLatency)));
        return true;
    }

    public function getLatencyPercent() {
        global $result;
        print_r($result . "%");
    }
}