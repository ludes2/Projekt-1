<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 31.10.2017
 * Time: 09:28
 */

include_once "db.php";

$email = $_POST['email'];
$password = $_POST['password'];


if(!($stmt = $db->prepare("SELECT email, password, nachname, vorname FROM staffplanner.users WHERE email = ? LIMIT 1"))) {
    echo "prepare failed: (" . $db->errno . " )" - $db->error;
}
if(!$stmt->bind_param('s', $email)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
if(!$stmt->execute()) {
    echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
}

/*get data from stmt*/
$stmt->bind_result($email, $db_password);
$stmt->fetch();

$encryptedPW = password_hash($password, PASSWORD_DEFAULT);

/*check if user exists*/
if(!$stmt->num_rows == 1) {
    echo("Your email address " . $email . " ist invalid");
    /*check if pw ist correct*/
} elseif (!password_verify($encryptedPW, $db_password)) {
    echo("your password is incorrect");
    } else {
    echo("Login successful");
}