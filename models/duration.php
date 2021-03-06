<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 14:01
 */

require_once "../PHP/db.php";

class duration {

    private $dur_id, $user_id, $durations;

    public function __construct() {

    }

    /**
     * @return mixed
     */
    public function getDurId() {
        return $this->dur_id;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getDurations() {
        return $this->durations;
    }


    /**
     * returns the last 5 durations as a 2D Array, from the specified user
     * @param $userId
     * @return array|null
     */
    public function getLastFiveDurationsOfUser($userId) {
        $lastFiveDurations = array();
        $userId = (int)$userId;
        $res = db::doQuery(
            "SELECT durations FROM projekt1.durations WHERE user_id = $userId ORDER BY dur_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($duration = $res->fetch_array()) {
            $lastFiveDurations[] = json_decode($duration['durations'], true); //Wäre doppleter Array
        }
        return $lastFiveDurations;
    }


    /**
     * @param $durId
     * @return null
     */
    public function getDurationById($durId) {
        $getDuration = array();
        $durId = (int)$durId;
        $res = db::doQuery(
            "SELECT durations FROM projekt1.durations WHERE dur_id = $durId"
        );
        if (!$res) return null;
        while ($duration = $res->fetch_array()) {
            $getDuration = json_decode($duration['durations'], true);
        }
        return $getDuration;
    }

    /**
     * returns the dur_id from the last entry
     * @return null
     */
    public function getLastDurationID() {

        $res = db::doQuery(
            "SELECT dur_id FROM projekt1.durations ORDER BY dur_id DESC LIMIT 1"
        );
        if (!$res) return null;
        $lastID = $res->fetch_array();
        return $lastID[0];
    }

    /**
    Count how many duration entries are in the DB
     **/
    public function sumDurationID() {

        $res = db::doQuery(
            "SELECT COUNT(dur_id) FROM projekt1.durations"
        );
        if (!$res) return null;
        $count = $res->fetch_array();
        return $count[0];
    }


    /**
     * @param $durId
     * @return bool
     */
    public static function delete($durId) {
        $durId = (int)$durId;
        $res = db::doQuery(
            "DELETE FROM projekt1.durations WHERE dur_id = $durId"
        );
        return $res != null;
    }

    /**
     * @param $durations
     * @param $userId
     * @return bool
     * @internal param $values
     */

    public function insert($durations, $userId) {

        $db = db::getInstance();
        $stmt = $db->prepare("INSERT INTO projekt1.durations (durations, user_id) VALUES (?, ?)");

        /**for debugging reasons we use echo statements for this method*/
        if (!$stmt) {
            echo "prepare failed: (" . $db->errno . " )" - $db->error;
        }
        if (!$stmt->bind_param('si', $durations, $userId)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    /**
     * @param $userID
     * @return array
     *
     * Calculate the average of durations with the last 5 entries
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
            $averages[] = round(array_sum($column) / count($lastFiveDurations));
        }
        return $averages;
    }
}