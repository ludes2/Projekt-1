<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 12.12.2017
 * Time: 09:40
 */

require_once "../models/interval.php";
require_once "../models/averages.php";
//require_once "../PHP/db.php";

class interval_controller
{

    private $intervalModel;
    private $averageModel;


    function __construct()
    {
        $this->intervalModel = new interval();
        $this->averageModel = new averages();
    }


    public function getIntervalModel()
    {
        return $this->intervalModel;
    }

    public function getIntervalAverage()
    {
        $userID = $_SESSION['userID'];
        $jsonIntervalAverage = json_encode($this->intervalModel->calculateAverage($userID));
        return $jsonIntervalAverage;
    }



    public function saveIntervalInDB($interval)
    {

        session_start();
        $userID = $_SESSION['userID'];
        $this->intervalModel->insert($interval, $userID);
    }




    /**
     * wandelt den Wert von compareInterval in % um
     */
    public function calculatePercent()
    {
    }


    public function saveIntervalAverage() {

        $userID = $_SESSION['userID'];
        $this->intervalModel->calculateAverage($userID);

    }



    public function compareInterval()
    {
        $lastID = $this->intervalModel->getLastIntervalID();
        $lastAverage = $this->averageModel->getLastAverageID();

        $intervalDB1 = $this->averageModel->getIntervalAveragesById($lastAverage);
        $intervalDB2 = abs($this->intervalModel->getIntervalById($lastID)); //abs weil - Werte möglich sind


        $limit = 100;
        $percentInterval = array();


        for ($i = 1; $i < sizeof($intervalDB1); $i++) {

            if (abs($intervalDB2[$i] - $intervalDB1[$i]) > $limit) {
                return false;
            }

            /* Werte in % umwandeln */
            if ($intervalDB2[$i] > $intervalDB1[$i]) {
                $percentInterval[$i] = (($intervalDB1[$i] * 100) / $intervalDB2[$i]);
            }

            if ($intervalDB2[$i] < $intervalDB1[$i]) {
                $percentInterval[$i] = (($intervalDB2[$i] * 100) / $intervalDB1[$i]);
            }
        }

        /* Summe von Array / Länge des Arrays, Gesamt % von Duration */
        $sum = array_sum($percentInterval);
        global $result;
        $result = (round($sum / sizeof($percentInterval)));
        return true;
    }

    public function getIntervalPercent() {
        global $result;
        print_r($result . "%");
    }
}