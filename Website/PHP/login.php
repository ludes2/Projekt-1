<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 31.10.2017
 * Time: 09:28
 */

include_once "db.php";

if(isset($_POST['email'], $_POST['password'])){

    $db = db::getInstance();

    $email = $_POST['email'];
    $password = $_POST['password'];


    if(!($stmt = $db->prepare("SELECT user_id, email, password, firstname, lastname FROM projekt1.users WHERE email = ? LIMIT 1"))) {
        echo "prepare failed: (" . $db->errno . " )" - $db->error;
    }
    if(!$stmt->bind_param('s', $email)) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if(!$stmt->execute()) {
        echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    /*check if user exists*/
    if(!$row_count = $result->num_rows == 1) {
        echo("Your email address " . $email . " is incorrect");
        /*check if pw ist correct*/
    } elseif (!password_verify($password, $row['password'])) {
        echo("your password is incorrect");
    } else {
        echo("Login successful");
    }

}
