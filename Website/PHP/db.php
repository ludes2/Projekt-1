<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 29.10.2017
 * Time: 14:51
 */

const HOST = "localhost";
const USER = "root";
const PW = "1223";
const DB_NAME = "projekt1";

/*create connection to DB*/
$db = new mysqli(HOST, USER, PW, DB_NAME);
if($db->connect_errno){ //returns last error code for most recent function call
    die("unable to connect to Database: " . $db->connect_error); //returns last error description for most resent function call
}

if(!$db->set_charset("utf8")){
    die("Error loading character set utf8: " . $db->error);
}