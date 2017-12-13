<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 22.11.2017
 * Time: 14:57
 */

class duration_view
{
    private $durationModel;
    private $route;

    function __construct(duration $durationModel)
    {
        //$this->route = $route;
        $this->durationModel = $durationModel;
    }


    /**
     * created only for testing reasons..
     * @param $userID
     */
    public function showLastFiveDurations($userID) {
        $lastFiveDurations = $this->durationModel->getLastFiveDurationsOfUser($userID);
        foreach ($lastFiveDurations as $key => $value){
            echo "duration index: " . $key . "= ";
            for($x=0 ; $x<count($value); $x++){
                echo $value[$x] . ", ";
            }
            echo "<br>";
        }

    }
}