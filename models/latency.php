<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 06.12.2017
 * Time: 15:39
 */

include_once "../PHP/db.php";
class latency
{
    private $lat_id, $user_id, $latencies;

    public function __construct()
    {
    }

    /**
     * @param $userId
     * @return array|null
     */
    public function getLastFiveLatenciesOfUser($userId)
    {
        $lastFiveLatencies = array();
        $userId = (int) $userId;
        $res = db::doQuery(
            "SELECT latencies FROM projekt1.latencies WHERE user_id = $userId ORDER BY lat_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($latencies = $res->fetch_array()) {
            $lastFiveLatencies[] = json_decode($latencies['latencies'], true);
        }
        return $lastFiveLatencies;
    }

    /**
     * @param $userID
     * @return array
     */
    public function calculateAverage($userID){
        $lastFiveLatencies = $this->getLastFiveLatenciesOfUser($userID);
        $averages = array();
        /**doesn't matter which row to take, they are all the same length...**/
        $length = sizeof($lastFiveLatencies[0]);
        for ($x=0; $x<$length; $x++){
            /**get the values of each column, sum them up and divide by the length of the lastFive durations
            in this case its 5, easy to change to other value**/
            $column = array_column($lastFiveLatencies, $x);
            $averages[] = array_sum($column) / count($lastFiveLatencies);
        }
        //var_dump($averages);
        return $averages;
    }


}