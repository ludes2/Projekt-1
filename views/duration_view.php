<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 22.11.2017
 * Time: 14:57
 */

class duration_view {

    private $durationModel;

    function __construct(duration $durationModel) {

        $this->durationModel = $durationModel;
    }

    /**
     * @param $userID
     * Used in home.php
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