<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 17:01
 */
require_once "login.php";

/**
 * @return array|bool
 */
function authenticate()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $data = checklogin($email, $password);
        $success = $data['success'];
        $userId = $data['userID'];


        if ($success == true) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // wenn login erfolgreich, dann auf home Seite weiterleiten
            header('location: http://localhost:63342/Projekt-1/views/home.php');
            $result = array('authenticated' => true, 'userID' => $userId);
            return $result;
        } else {
            return false;
        }
        return $result;
    }

}



//    $router = new router();
//    $frontController = new front_controller($router, $_GET['route']);









//$duration = new duration();
//
//$d_controller = new duration_controller($duration);
//$av_controller = new averages_controller($averages);
//
//
//global $json;
//
//
//
//if (isset($_POST['jsonDuration'])) {
//    $json = $_POST['jsonDuration'];
//    $d_controller->saveDurationInDB($json); //var_dump geht nicht in if statement
//    $test = $duration->calculateAverage($_SESSION['userID']);
//    $av_controller->saveAveragesInDB($test);
//}
//
//
//
////if(!isset($_SESSION['userMail'])) {
////    echo "please log in"; //can also link to the loginpage
////    exit;
////}
//
//    if (isset($_POST['jsonDuration'])) {
//        $json = $_POST['jsonDuration'];
//        $d_controller->saveDurationInDB($json);
//        //$d_controller->saveDurationAverage();
//    }

