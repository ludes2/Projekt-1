<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 06.12.2017
 * Time: 15:48
 */

class interval
{
    private $interval_id, $user_id, $intervals;

    public function __construct()
    {
    }



    /**
     * @param $userId
     * @return array|null
     */
    public function getLastFiveIntervalsOfUser($userId)
    {
        $lastFiveIntervals = array();
        $userId = (int) $userId;
        $res = db::doQuery(
            "SELECT intervals FROM projekt1.intervals WHERE user_id = $userId ORDER BY interval_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($intervals = $res->fetch_array()) {
            $lastFiveIntervals[] = json_decode($intervals['intervals'], true);
        }
        return $lastFiveIntervals;
    }

    /**
     * @param $userID
     * @return array
     */
    public function calculateAverage($userID){
        $lastFiveIntervals = $this->getLastFiveIntervalsOfUser($userID);
        $averages = array();
        /**doesn't matter which row to take, they are all the same length...**/
        $length = sizeof($lastFiveIntervals[0]);
        for ($x=0; $x<$length; $x++){
            /**get the values of each column, sum them up and divide by the length of the lastFive durations
            in this case its 5, easy to change to other value**/
            $column = array_column($lastFiveIntervals, $x);
            $averages[] = array_sum($column) / count($lastFiveIntervals);
        }
        //var_dump($averages);
        return $averages;
    }
}