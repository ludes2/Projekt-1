<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 12.11.2017
 * Time: 16:45
 */

include "../models/duration.php";
include_once "../PHP/db.php";

class duration_controller
{

    private $durationModel;

    /**
     * duration_controller constructor.
     * @param duration $durationModel
     */


    function __construct(duration $durationModel)
    {
        $this->durationModel = $durationModel;

    }





//    public function saveDurationInDB($duration)
//    {
//
//        return $this->durationModel->insert($duration, '7', '5');
//    }

//    public function compareDuration($jsonDuration)
//    {
//
//
//        if (isset($_POST['jsonDuration'])) {
//            $duration = $_POST['jsonDuration'];
//            //echo $_POST['jsonDuration'];
//            $this->durationModel->insert($duration, 10, 5);
//            //duration::insert($duration, 10, 5);
//
//            /*Berechnet Duration. Wenn Werte mehr als 30 ms auseinander -> False*/
//            $testDuration = array("86", "78", "98", "86", "87"); /* Array mit hallo hier sollte average aus db sein */
//            $percentDuration = array();
//            $saveDuration = $jsonDuration;
//
//            $limit = 30;
//
//
//            for ($i = 0; $i < 5; $i++) {
//
//                if (abs($testDuration[$i] - $saveDuration[$i]) > $limit) {
//                    echo("Fehler - Person nicht erkannt");
//                    break;
//                }
//
//                /* Werte in % umwandeln */
//                if ($testDuration[$i] > $saveDuration[$i]) {
//                    $percentDuration[$i] = (($saveDuration[$i] * 100) / $testDuration[$i]);
//                }
//
//                if ($testDuration[$i] < $saveDuration[$i]) {
//                    $percentDuration[$i] = (($testDuration[$i] * 100) / $saveDuration[$i]);
//                }
//            }
//        }
//    }


    public function saveDurationInDB($duration)
    {

        $this->durationModel->insert($duration, '10', '5');
    }



    public function compareDuration($jsonDuration)
    {

        $durationDB = $this->durationModel->getDurationById('2');
        var_dump($durationDB);


        $getJSON = array();
        $getJSON[] = json_decode($jsonDuration['durations'], true);
        var_dump($getJSON);


        //$limit = 30;
        //$percentDuration = array();

        /*
        for ($i = 0; $i < sizeof($getDuration); $i++) {

            if (abs($getDuration[$i] - $saveDuration[$i]) > $limit) {
                return false;
            }

            /* Werte in % umwandeln
            if ($getDuration[$i] > $saveDuration[$i]) {
                $percentDuration[$i] = (($saveDuration[$i] * 100) / $getDuration[$i]);
            }

            if ($getDuration[$i] < $saveDuration[$i]) {
                $percentDuration[$i] = (($getDuration[$i] * 100) / $saveDuration[$i]);
            }
        }*/
    }
}



            /* Summe von Array / Länge des Arrays, Gesamt % von Duration
            echo(round(percentDuration.reduce(getSum) / percentDuration.length) + "%"); */
//        }
//    }
//}