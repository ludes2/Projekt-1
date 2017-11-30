<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 19:12
 */

session_start();
if(session_destroy()) {
    header('Location: index.php');
}
