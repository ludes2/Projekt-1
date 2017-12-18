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
     * @return mixed
     */
    public function getLatId()
    {
        return $this->lat_id;
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
    public function getLatencies()
    {
        return $this->latencies;
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
     * @param $latId
     * @return null
     */
    public function getLatencyById($latId)
    {
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


    public function getLastLatencyID() {

        $res = db::doQuery(
            "SELECT projekt1.latencies.lat_id FROM projekt1.latencies ORDER BY lat_id DESC LIMIT 1"
        );
        if (!$res) return null;
    }


    /**
     * @param $latId
     * @return bool
     */
    public static function delete($latId)
    {
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

    public function insert($latencies, $userId)
    {

        $db = db::getInstance();

        $result = $db->query("SELECT projekt1.durations.dur_id FROM projekt1.durations order by dur_id DESC;");
        $row = $result->fetch_assoc();
        $idCounter = $row["dur_id"];


        $stmt = $db->prepare("INSERT INTO projekt1.latencies (latencies, lat_id, user_id) VALUES ('$latencies', '5', '5')");

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