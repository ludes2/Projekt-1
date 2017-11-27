<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 10.11.2017
 * Time: 14:01
 */
include_once "model_interface.php";
include_once "../Website/PHP/db.php";
class duration implements model_interface {

    private $dur_id, $user_id, $durations;

    public function __construct() {

    }

    /**
     *
     */
//    public function calculateAverageDuration($userId)
//    {
//        $lastFiveDurations = $this->getLastFiveDurationsOfUser($userId);
//        averages = []
//        foreach($array : $lastFIve...)
//            $real_numbers = []
//            $numbers = $array.split(",")
//                foreach ($number : $numbers)
//                    $real_numbers << $number.trim.toInt
//
//           $averages << real_numbers.avg
//        $averages.avg
//        echo $lastFiveDurations;
//
//    }

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
     * @param $userId
     * @return array|null
     */
    public static function getLastFiveDurationsOfUser($userId) {
        $lastFiveDurations = array();
        $userId = (int) $userId;
        $res = db::doQuery(
            "SELECT durations FROM projekt1.durations WHERE user_id = $userId ORDER BY dur_id DESC LIMIT 5"
        );
        if(!$res) return null;
        while($duration = $res->fetch_array()){
            $lastFiveDurations[] = json_decode($duration['durations'], true);
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
            "SELECT durations FROM projekt1.durations WHERE dur_id = $durId"
        );
        if(!$res) return null;
        return $res->fetch_row();
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

    public function calculateAverageDuration($userId)
    {
        // TODO: Implement calculateAverageDuration() method.
    }
}