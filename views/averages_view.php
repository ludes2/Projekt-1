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

    public function showDurationAverages($userID){
        $averages = $this->averagesModel->getDurationAverage($userID);
        foreach ($averages as $key => $value){
            echo "average index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }
    }

}