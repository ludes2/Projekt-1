<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 14:01
 */

class duration implements model_interface {

    private $dur_id, $user_id, $durations, $created_at;

    function __construct() {

    }

    /**
     *
     */
    public function calculateAverageDuration()
    {
        $lastFiveDurations = $this->getLastFiveDurationsOfUser();
    }

    public function calculateAverage()
    {
        // TODO: Implement calculateAverage() method.
    }

    public function calculateAverageLatency()
    {
        // TODO: Implement calculateAverageLatency() method.
    }

    public function calculateAverageInterval()
    {
        // TODO: Implement calculateAverageIntercal() method.
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
     * @return mixed
     */
    public function getCreatedAt() {
        return $this->created_at;
    }


    /**
     * @param $userId
     * @return array|null
     */
    public function getLastFiveDurationsOfUser($userId) {
        $lastFiveDurations = array();
        $userId = (int) $userId;
        $res = db::doQuery(
            "SELECT * FROM projekt1.durations WHERE user_id = $userId ORDER BY dur_id DESC LIMIT 5"
        );
        if(!$res) return null;
        while($duration = $res->fetch_object(get_class())){
            $lastFiveDurations[] = $duration;
        }
        return $lastFiveDurations;
    }


    /**
     * @param $durId
     * @return null
     */
    public static function getDurationById($durId) {
        $durId = (int) $durId;
        $res = db::doQuery(
            "SELECT * FROM projekt1.durations WHERE dur_id = $durId"
        );
        if(!$res) return null;
        return $res->fetch_object(get_class());
    }

    /**
     * @param $durId
     * @return bool
     */
    public static function delete($durId) {
        $durId = (int) $durId;
        $res = db::doQuery(
            "DELETE FROM projekt1.durations WHERE dur_id = $durId"
        );
        return $res != null;
    }

    /**
     * @param $values
     * @return bool
     */
    public static function insert($values) {
        $stmt = db::getInstance()->prepare(
            "INSERT INTO projekt1.durations" . "(user_id, durations) " .
            "VALUE (?, ?, ?)"
        );
        if(!$stmt) return false;
        $success = $stmt->bind_param('is',
            $values['user_id'],
            $values['durations']
        );
        if(!$success) return false;
        return $stmt->execute();
    }









}