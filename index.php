<?php
/**
 * Created by PhpStorm.
 * User: Rickard
 * Date: 2016-09-09
 * Time: 11:51
 */

//Include the database connector
include_once "Database.php";
if (!isset($db)) {
    $db = new Database("localhost", "root", "", "school");
}

// Check if page is set
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    // Load appropriate page
    if ($p == 'menu') {
        include 'menu.php';
    } else if ($p == 'info') {
        include 'info.php';
    } else if ($p == 'updateStudent') {
        include 'student/update_student.php';
    } else if ($p == 'insertStudent') {
        include 'student/insert_student.php';
    } else if ($p == 'insertParent') {
        include 'parent/insert_parent.php';
    } else { // Failsafe
        include 'start.php';
    }
} else { // load startpage.
    include 'start.php';
}