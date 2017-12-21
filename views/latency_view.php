<?php
/**
 * Created by PhpStorm.
 * User: KieligerM
 * Date: 13.12.2017
 * Time: 10:05
 */

class latency_view {

    private $latencyModel;

    function __construct(latency $latencyModel) {

        $this->latencyModel = $latencyModel;
    }

    /**
     * @param $userID
     * Used in home.php
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