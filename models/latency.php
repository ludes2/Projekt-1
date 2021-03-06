<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 06.12.2017
 * Time: 15:39
 */

require_once "../PHP/db.php";

class latency {

    private $lat_id, $user_id, $latencies;

    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function getLatId() {
        return $this->lat_id;
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
    public function getLatencies() {
        return $this->latencies;
    }

    /**
     * returns the last 5 latency's as a 2D Array, from the specified user
     * @param $userId
     * @return array|null
     */
    public function getLastFiveLatenciesOfUser($userId) {
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
     * @param $latId
     * @return null
     */
    public function getLatencyById($latId) {
        $getLatency = array();
        $latId = (int)$latId;
        $res = db::doQuery(
            "SELECT projekt1.latencies.latencies FROM projekt1.latencies WHERE lat_id = $latId"
        );
        if (!$res) return null;
        while ($latency = $res->fetch_array()) {
            $getLatency = json_decode($latency['latencies'], true);
        }
        return $getLatency;
    }


    /**
     * @return null
     */
    public function getLastLatencyID() {

        $res = db::doQuery(
            "SELECT lat_id FROM projekt1.latencies ORDER BY lat_id DESC LIMIT 1"
        );
        if (!$res) return null;
        $lastID = $res->fetch_array();
        return $lastID[0];
    }


    /**
     * @param $latId
     * @return bool
     */
    public static function delete($latId) {
        $latId = (int)$latId;
        $res = db::doQuery(
            "DELETE FROM projekt1.latencies WHERE lat_id = $latId"
        );
        return $res != null;
    }

    /**
     * @param $latencies
     * @param $userId
     * @return bool
     * @internal param $values
     */

    public function insert($latencies, $userId) {

        $db = db::getInstance();

        $stmt = $db->prepare("INSERT INTO projekt1.latencies (latencies, user_id) VALUES (?, ?)");


        /**for debugging reasons we use echo statements for this method*/
        if (!$stmt) {
            echo "prepare failed: (" . $db->errno . " )" - $db->error;
        }
        if (!$stmt->bind_param('si', $latencies, $userId)) {
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
     * Calculate the average of latency with the last 5 entries
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
            $averages[] = round(array_sum($column) / count($lastFiveLatencies));
        }
        return $averages;
    }
}