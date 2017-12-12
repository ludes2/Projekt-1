<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:30
 */

include "../models/duration.php";
require_once "../PHP/db.php";
//session_start();

class averages_controller {

    private $averages;

    /**
     * averages_controller constructor.
     * @param averages $averages
     */
    function __construct() {
        $this->averages =  new averages();
    }


    /**
     * @param $averages
     */
    public function saveAveragesInDB($averages)
    {
        $userID = $_SESSION['userID'];
        $this->averages->insert($averages, $userID);

    }

    public function getAverages()
    {
        return $this->averages;
    }





}