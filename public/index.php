<?php
/**
 * Created by PhpStorm.
 * User: Rickard
 * Date: 2016-09-09
 * Time: 11:51
 */

//Include the database connector
include_once "../Database.php";
if (!isset($db)) {
    $db = new Database("localhost", "root", "", "school");
}

function redirect($page) {
    header("Location: index.php?p=".$page);
    die();
}

// Check if page is set
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    // Load appropriate page
    if ($p == 'menu') {
        include '../menu.php';
    } else if ($p == 'info') {
        include '../info.php';
    } else if ($p == 'updateStudent') {
        include '../student/update_student.php';
    } else if ($p == 'insertStudent') {
        include '../student/insert_student.php';
    } else if ($p == 'listStudent') {
        include '../student/list_student.php';
    } else if ($p == 'deleteStudent') {
        include '../student/delete_student.php';
    } else if ($p == 'insertParent') {
        include '../parent/insert_parent.php';
    } else if ($p == 'updateParent') {
        include '../parent/update_parent.php';
    } else if ($p == 'listParent') {
        include '../parent/list_parent.php';
    } else if ($p == 'deleteParent') {
        include '../parent/delete_parent.php';
    } else if ($p == 'listClass') {
        include '../class/list_class.php';
    } else if ($p == 'updateClass') {
        include '../class/update_class.php';
    } else if ($p == 'insertClass') {
        include '../class/insert_class.php';
    } else if ($p == 'deleteClass') {
        include '../class/delete_class.php';
    } else { // Failsafe
        include '../start.php';
    }
} else { // load startpage.
    include '../start.php';
}