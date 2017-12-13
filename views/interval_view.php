<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 13.12.2017
 * Time: 10:05
 */

class interval_view
{
    private $intervalModel;
    private $route;

    function __construct(interval $intervalModel)
    {
        //$this->route = $route;
        $this->intervalModel = $intervalModel;
    }


    /**
     * created only for testing reasons..
     * @param $userID
     */
    public function showLastFiveIntervals($userID) {
        $lastFiveIntervals = $this->intervalModel->getLastFiveIntervalsOfUser($userID);
        foreach ($lastFiveIntervals as $key => $value){
            echo "interval index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }

    }
}