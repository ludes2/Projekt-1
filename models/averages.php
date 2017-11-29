<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 16:15
 */

include_once "../Website/PHP/db.php";
include_once "duration.php";

class averages {

    private $av_id, $user_id, $dur_id, $av_duration, $lat_id, $av_latency, $interval_id, $av_interval;
    //private $duration;

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

    /**
     * @param $avId
     * @return null
     */
    public static function getAveragesById($avId) {
        $avId = (int) $avId;
        $res = db::doQuery(
            "SELECT * FROM projekt1.averages WHERE av_id = $avId"
        );
        if(!$res) return null;
        return $res->fetch_object(get_class());
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
     * @param $values
     * @return bool
     */
    public function insert($values){
        $stmt = db::getInstance()->prepare(
            "INSERT INTO projekt1.averages" . "(av_duration)" .
            "VALUE (?)"
        );
        if(!$stmt) return false;
        $success = $stmt->bind_param('s',
            $values['av_duration']
        );
        if(!$success) return false;
        return $stmt->execute();
    }

    /**
     * @param $userID
     * @return null
     */
    public function getDurationAverage($userID){
        $userID = (int) $userID;
        $result = db::doQuery(
            "SELECT av_duration FROM projekt1.averages WHERE user_id = $userID"
        );
        if(!$result) return null;
        return $result->fetch_row();

    }



}