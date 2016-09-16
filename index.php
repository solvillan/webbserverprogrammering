<?php
/**
 * Created by PhpStorm.
 * User: Rickard
 * Date: 2016-09-09
 * Time: 11:51
 */

//Include the database connector
include_once "Database.php";
$db = new Database("localhost", "root", "", "school");

// Check if page is set
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    // Load appropriate page
    if ($p == 'menu') {
        include 'menu.php';
    } else if ($p == 'info') {
        include 'info.php';
    } else if ($p == 'updateStudent') {
        include 'update_student.php';
    } else { // Failsafe
        include 'start.php';
    }
} else { // load startpage.
    include 'start.php';
}