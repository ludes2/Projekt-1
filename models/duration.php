<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 14:01
 */

include_once "../PHP/db.php";
class duration
{

    private $dur_id, $user_id, $durations;

    public function __construct()
    {

    }



    /**
     * @return mixed
     */
    public function getDurId()
    {
        return $this->dur_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getDurations()
    {
        return $this->durations;
    }


    /**
     * @param $userId
     * @return array|null
     */
    public function getLastFiveDurationsOfUser($userId)
    {
        $lastFiveDurations = array();
        $userId = (int)$userId;
        $res = db::doQuery(
            "SELECT durations FROM projekt1.durations WHERE user_id = $userId ORDER BY dur_id DESC LIMIT $userId"
        );
        if (!$res) return null;
        while ($duration = $res->fetch_array()) {
            $lastFiveDurations[] = json_decode($duration['durations'], true);
        }
        return $lastFiveDurations;
    }


    /**
     * @param $durId
     * @return null
     */
    public function getDurationById($durId)
    {
        $durId = (int)$durId;
        $res = db::doQuery(
            "SELECT durations FROM projekt1.durations WHERE dur_id = $durId"
        );
        if (!$res) return null;
        return $res->fetch_row();
    }

    /**
     * @param $durId
     * @return bool
     */
    public static function delete($durId)
    {
        $durId = (int)$durId;
        $res = db::doQuery(
            "DELETE FROM projekt1.durations WHERE dur_id = $durId"
        );
        return $res != null;
    }

    /**
     * @param $values
     * @return bool
     */
    public static function insert($values)
    {
        $stmt = db::getInstance()->prepare(
            "INSERT INTO projekt1.durations" . "(user_id, durations) " .
            "VALUE (?, ?, ?)"
        );
        if (!$stmt) return false;
        $success = $stmt->bind_param('is',
            $values['user_id'],
            $values['durations']
        );
        if (!$success) return false;
        return $stmt->execute();
    }


    /**
     * @param $userID
     * @return array
     */
    public function calculateAverage($userID){
        $lastFiveDurations = $this->getLastFiveDurationsOfUser($userID);
        $averages = array();
        /**doesn't matter which row to take, they are all the same length...**/
        $length = sizeof($lastFiveDurations[0]);
        for ($x=0; $x<$length; $x++){
            /**get the values of each column, sum them up and divide by the length of the lastFive durations
            in this case its 5, easy to change to other value**/
            $column = array_column($lastFiveDurations, $x);
            $averages[] = array_sum($column) / count($lastFiveDurations);
        }
        //var_dump($averages);
        return $averages;
    }
}
