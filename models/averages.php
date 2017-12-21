<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 16:15
 */

require_once "../PHP/db.php";


class averages {

    private $av_id, $user_id, $dur_id, $av_duration, $lat_id, $av_latency, $interval_id, $av_interval;

    function __construct() {

    }

    /**
     * @return mixed
     */
    public function getAvId() {
        return $this->av_id;
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
    public function getDurId() {
        return $this->dur_id;
    }

    /**
     * @return mixed
     */
    public function getAvDuration() {
        return $this->av_duration;
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
    public function getAvLatency() {
        return $this->av_latency;
    }

    /**
     * @return mixed
     */
    public function getIntervalId() {
        return $this->interval_id;
    }

    /**
     * @return mixed
     */
    public function getAvInterval() {
        return $this->av_interval;
    }

    public function getLastFiveDurationAveragesOfUser($userId)
    {
        $lastFiveAverages = array();
        $userId = (int)$userId;
        $res = db::doQuery(
            "SELECT av_duration FROM projekt1.averages WHERE user_id = $userId ORDER BY av_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $lastFiveAverages[] = json_decode($averages['av_duration'], true); //Wäre doppleter Array
        }
        return $lastFiveAverages;
    }

    public function getLastFiveIntervalAveragesOfUser($userId)
    {
        $lastFiveAverages = array();
        $userId = (int)$userId;
        $res = db::doQuery(
            "SELECT av_interval FROM projekt1.averages WHERE user_id = $userId ORDER BY av_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $lastFiveAverages[] = json_decode($averages['av_interval'], true); //Wäre doppleter Array
        }
        return $lastFiveAverages;
    }

    public function getLastFiveLatencyAveragesOfUser($userId)
    {
        $lastFiveAverages = array();
        $userId = (int)$userId;
        $res = db::doQuery(
            "SELECT av_latency FROM projekt1.averages WHERE user_id = $userId ORDER BY av_id DESC LIMIT 5"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $lastFiveAverages[] = json_decode($averages['av_latency'], true); //Wäre doppleter Array
        }
        return $lastFiveAverages;
    }

    /**
     * @param $avId
     * @return null
     */
    public function getDurationAveragesById($avId) {
        $getDurationAverages = array();
        $avId = (int)$avId;
        $res = db::doQuery(
            "SELECT av_duration FROM projekt1.averages WHERE av_id = $avId"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $getDurationAverages = json_decode($averages['av_duration'], true);
        }
        return $getDurationAverages;
    }

    public function getIntervalAveragesById($avId) {
        $getIntervalAverages = array();
        $avId = (int)$avId;
        $res = db::doQuery(
            "SELECT av_interval FROM projekt1.averages WHERE av_id = $avId"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $getIntervalAverages = json_decode($averages['av_interval'], true);
        }
        return $getIntervalAverages;
    }

    public function getLatencyAveragesById($avId) {
        $getLatencyAverages = array();
        $avId = (int)$avId;
        $res = db::doQuery(
            "SELECT av_latency FROM projekt1.averages WHERE av_id = $avId"
        );
        if (!$res) return null;
        while ($averages = $res->fetch_array()) {
            $getLatencyAverages = json_decode($averages['av_latency'], true);
        }
        return $getLatencyAverages;
    }

    public function getLastAverageID() {

        $res = db::doQuery(
            "SELECT av_id FROM projekt1.averages ORDER BY av_id DESC LIMIT 1"
        );
        if (!$res) return null;
        $lastID = $res->fetch_array();
        return $lastID[0];
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id) {
        $id = (int) $id;
        $res = db::doQuery(
            "DELETE FROM projekt1.averages WHERE av_id = $id"
        );
        return $res != null;
    }

    /**
     * @param $iAverage
     * @param $lAverage
     * @param $dAverage
     * @param $userId
     * @return bool
     *
     * Insert IntervalAverage, LatencyAverage, DurationAverage and UserID in DB
     */
    public function insertAverage($iAverage, $lAverage, $dAverage, $userId)
    {
        $db = db::getInstance();
        $stmt = $db->prepare("INSERT INTO projekt1.averages (av_interval, av_latency, av_duration, user_id) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            echo "prepare failed: (" . $db->errno . " )" - $db->error;
        }
        if (!$stmt->bind_param('sssi', $iAverage, $lAverage, $dAverage, $userId)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    /**
     * @param $userID
     * @return null
     */
    public function getDurationAverage($userID){
        $userID = (int) $userID;
        $averages = array();
        $result = db::doQuery(
            "SELECT av_duration FROM projekt1.averages WHERE user_id = $userID ORDER BY av_id DESC LIMIT 5"
        );
        if(!$result) return null;
        while($row = $result->fetch_array()){
            $averages = json_decode($row['av_duration'], true);
        }
        return $averages;
    }

    /**
     * @param $userID
     * @return null
     */
    public function getIntervalAverage($userID){
        $userID = (int) $userID;
        $averages = array();
        $result = db::doQuery(
            "SELECT av_interval FROM projekt1.averages WHERE user_id = $userID ORDER BY av_id DESC LIMIT 5"
        );
        if(!$result) return null;
        while($row = $result->fetch_array()){
            $averages = json_decode($row['av_interval'], true);
        }
        return $averages;
    }

    /**
     * @param $userID
     * @return null
     */
    public function getLatencyAverage($userID){
        $userID = (int) $userID;
        $averages = array();
        $result = db::doQuery(
            "SELECT av_latency FROM projekt1.averages WHERE user_id = $userID ORDER BY av_id DESC LIMIT 5"
        );
        if(!$result) return null;
        while($row = $result->fetch_array()){
            $averages = json_decode($row['av_latency'], true);
        }
        return $averages;
    }
}