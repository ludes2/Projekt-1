<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 12.12.2017
 * Time: 09:41
 */


require_once "../models/latency.php";
require_once "../PHP/db.php";

class latency_controller
{

    private $latencyModel;


    function __construct()
    {
        $this->latencyModel = new latency();
    }


    public function getLatencyModel()
    {
        return $this->latencyModel;
    }


    public function saveLatencyInDB($latency)
    {

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

        $latencyDB1 = $this->latencyModel->getLatencyById('5'); //Hier Average Wert
        $latencyDB2 = $this->latencyModel->getLatencyById('6'); //Hier Last ID


        $limit = 50;
        $percentLatency = array();


        for ($i = 0; $i < sizeof($latencyDB1); $i++) {

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