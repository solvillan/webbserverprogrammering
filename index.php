<?php
/**
 * Created by PhpStorm.
 * User: Rickard
 * Date: 2016-09-09
 * Time: 11:51
 */

//Include the database connector
include "Database.php";
$db = new Database();

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    if ($p == 'menu') {
        include 'menu.php';
    } else if ($p == 'info') {
        include 'info.php';
    } else {
        include 'start.php';
    }
} else {
    include 'start.php';
}