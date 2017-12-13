<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 13.12.2017
 * Time: 10:05
 */

class latency_view
{
    private $latencyModel;
    private $route;

    function __construct(latency $latencyModel)
    {
        //$this->route = $route;
        $this->latencyModel = $latencyModel;
    }


    /**
     * created only for testing reasons..
     * @param $userID
     */
    public function showLastFiveLatencies($userID) {
        $lastFiveLatencies = $this->latencyModel->getLastFiveLatenciesOfUser($userID);
        foreach ($lastFiveLatencies as $key => $value){
            echo "latency index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }

    }
}