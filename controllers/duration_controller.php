<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include "../models/duration.php";
include_once "../PHP/db.php";

class duration_controller {

    private $durationModel;

    /**
     * duration_controller constructor.
     * @param duration $durationModel
     */

    /*
    function __construct(duration $durationModel) {
        $this->durationModel = $durationModel;

    }
    */

    function __construct(){
    }

    public static function saveDurationInDB($duration) {

        return duration::insert($duration, '10',  '6');
    }

    public function compareDuration($jsonDuration) {

<<<<<<< HEAD
        if (isset($_POST['jsonDuration'])) {
            $duration = $_POST['jsonDuration'];
            //echo $_POST['jsonDuration'];
            $this->durationModel->insert($duration, 1);
=======
        /*Berechnet Duration. Wenn Werte mehr als 30 ms auseinander -> False*/
        $testDuration = array("86", "78", "98", "86", "87"); /* Array mit hallo hier sollte average aus db sein */
        $percentDuration = array();
        $saveDuration = $jsonDuration;

        $limit = 30;
>>>>>>> c0a58463fd5be9f808c919a6ce33d162a2f285d6

        for ($i = 0; $i < 5; $i++) {

            if (abs($testDuration[$i] - $saveDuration[$i]) > $limit) {
                echo("Fehler - Person nicht erkannt");
                break;
            }

            /* Werte in % umwandeln */
            if ($testDuration[$i] > $saveDuration[$i]) {
                $percentDuration[$i] = (($saveDuration[$i] * 100) / $testDuration[$i]);
            }

            if ($testDuration[$i] < $saveDuration[$i]) {
                $percentDuration[$i] = (($testDuration[$i] * 100) / $saveDuration[$i]);
            }
        }

    /* Summe von Array / Länge des Arrays, Gesamt % von Duration
    echo(round(percentDuration.reduce(getSum) / percentDuration.length) + "%"); */
}

}

