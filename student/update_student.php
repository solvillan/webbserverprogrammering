<?php
if (!isset($db)) {
    header("Location: index.php");
    die();
}
?>

<?php
// Init vars
if (isset($_GET['sid']) && $_GET['sid'] != "") {
    $id = $db->number_format($_GET['sid']);
} else if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $db->number_format($_POST['id']);
} else {
    $id = 1;
}
$student = $db->select("*", "student", "id=".$id)->fetch_array();
$scgrades = $db->select("*", "student_class", "student_id=".$id);
$grades = [];
$sp = $db->select("*", "student_parent", "student_id=".$id);
$classes = [];
$parents = [];

while ($row = $scgrades->fetch_array()) {
    $tmp = $db->select("*", "class", "id=".$row['class_id']);
    while ($c = $tmp->fetch_array()) {
        $grades[$c['id']] = $row['grade'];
        $classes[] = $c;
    }
}
while ($prow = $sp->fetch_array()) {
    $tmp = $db->select("*", "parent", "id=".$prow['parent_id']);
    while ($p = $tmp->fetch_array()) {
        $parents[] = $p;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - <?php echo $student['fname']." ".$student["ename"]; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="backBtn">
    <a href="index.php?p=listStudent" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1><?php echo $student['fname']." ".$student["ename"]; ?></h1>
    <?php

    if (isset($_POST['id'])) {
        if (isset($_POST['fname'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $fname = $_POST['fname'];
            $stmt = $db->createUpdate(["fname"], "student", "id=?");
            $stmt->bind_param("si", $fname, $id);
            $stmt->execute();
        }
        if (isset($_POST['ename'])) {
            //$db->update("ename", "'".$db->escape_string($_POST['ename'])."'", "student", "id=".$db->number_format($_POST['id']));
            $ename = $_POST['ename'];
            $stmt = $db->createUpdate(["ename"], "student", "id=?");
            $stmt->bind_param("si", $ename, $id);
            $stmt->execute();
        }
        if (isset($_POST['address'])) {
            //$db->update("address", "'".$db->escape_string($_POST['address'])."'", "student", "id=".$db->number_format($_POST['id']));
            $address = $_POST['address'];
            $stmt = $db->createUpdate(["address"], "student", "id=?");
            $stmt->bind_param("si", $address, $id);
            $stmt->execute();
        }
        if (isset($_POST['email'])) {
            //$db->update("email", "'".$db->escape_string($_POST['email'])."'", "student", "id=".$db->number_format($_POST['id']));
            $email = $_POST['email'];
            $stmt = $db->createUpdate(["email"], "student", "id=?");
            $stmt->bind_param("si", $email, $id);
            $stmt->execute();
        }
        echo "<h3>Uppdaterad</h3><br>";
        echo "<a class='regular regularBtn' href='index.php?p=updateStudent&sid=".$_POST['id']."'>Tillbaka</a>";
    } else {
        include 'update_student_form.php';
    }

    ?>
</section>
</body>
</html>