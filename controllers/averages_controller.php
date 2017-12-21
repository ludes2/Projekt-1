<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:30
 */
require_once "../models/averages.php";

class averages_controller {

    private $averages;

    /**
     * averages_controller constructor.
     * @param averages
     */
    function __construct() {

        $this->averages =  new averages();
    }


    /**
     * @param iAverages
     * @param lAverages
     * @param dAverages
     *
     * Saves averages from Interval, Latency and Duration in DB
     */
    public function saveAveragesInDB($iAverage, $lAverage, $dAverage) {

        $userID = $_SESSION['userID'];
        $this->averages->insertAverage($iAverage, $lAverage, $dAverage, $userID);
    }


    public function getAverages() {

        return $this->averages;
    }
}