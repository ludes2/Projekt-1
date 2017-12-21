<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 28.11.2017
 * Time: 19:43
 */

class averages_view
{
    private $averagesModel;

    function __construct(averages $averages_model)
    {
        $this->averagesModel = $averages_model;
    }

    public function showLastFiveDurationAverages($userID){
        $averages = $this->averagesModel->getLastFiveDurationAveragesOfUser($userID);
        foreach ($averages as $key => $value){
            echo "Duration average index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }
    }

    public function showLastFiveIntervalAverages($userID){
        $averages = $this->averagesModel->getLastFiveIntervalAveragesOfUser($userID);
        foreach ($averages as $key => $value){
            echo "Interval average index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }
    }

    public function showLastFiveLatencyAverages($userID){
        $averages = $this->averagesModel->getLastFiveLatencyAveragesOfUser($userID);
        foreach ($averages as $key => $value){
            echo "Latency average index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }
    }

}