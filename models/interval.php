<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 06.12.2017
 * Time: 15:48
 */

require_once "../PHP/db.php";

class interval
{
    private $interval_id, $user_id, $intervals;

    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getIntId()
    {
        return $this->interval_id;
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
    public function getIntervals()
    {
        return $this->intervals;
    }


    /**
     * @param $userId
     * @return array|null
     */
    public function getLastFiveIntervalsOfUser($userId)
    {
        $lastFiveIntervals = array();
        $userId = (int)$userId;
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
     * @param $intId
     * @return null
     */
    public function getIntervalById($intId)
    {
        $getInterval = array();
        $intId = (int)$intId;
        $res = db::doQuery(
            "SELECT projekt1.intervals.intervals FROM projekt1.intervals WHERE interval_id = $intId"
        );
        if (!$res) return null;
        while ($interval = $res->fetch_array()) {
            $getInterval = json_decode($interval['intervals'], true);
        }
        return $getInterval;
    }


    public function getLastIntervalID() {

        $res = db::doQuery(
            "SELECT interval_id FROM projekt1.intervals ORDER BY interval_id DESC LIMIT 1"
        );
        if (!$res) return null;
        $lastID = $res->fetch_array();
        return $lastID[0];
    }


    /**
     * @param $intId
     * @return bool
     */
    public static function delete($intId)
    {
        $intId = (int)$intId;
        $res = db::doQuery(
            "DELETE FROM projekt1.intervals WHERE interval_id = $intId"
        );
        return $res != null;
    }


    public function insert($intervals, $userId)
    {

        $db = db::getInstance();

        /*$result = $db->query("SELECT projekt1.durations.dur_id FROM projekt1.durations order by dur_id DESC;");
        $row = $result->fetch_assoc();
        $idCounter = $row["dur_id"];*/

        $stmt = $db->prepare("INSERT INTO projekt1.intervals (intervals, user_id) VALUES (?, ?)");

        /**for debugging reasons we use echo statements for this method*/
        if (!$stmt) {
            echo "prepare failed: (" . $db->errno . " )" - $db->error;
        }
        if (!$stmt->bind_param('si', $intervals, $userId)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
        }
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
            $averages[] = round(array_sum($column) / count($lastFiveIntervals));
        }
        //var_dump($averages);
        return $averages;
    }
}