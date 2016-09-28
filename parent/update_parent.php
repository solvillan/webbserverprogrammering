<?php
if (!isset($db)) {
    header("Location: index.php");
    die();
}
?>

<?php
// Init vars
if (isset($_GET['pid']) && $_GET['pid'] != "") {
    $id = $db->number_format($_GET['pid']);
} else if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $db->number_format($_POST['id']);
} else {
    $id = 1;
}
$parent = $db->select("*", "parent", "id=".$id)->fetch_array();
$sp = $db->select("*", "student_parent", "parent_id=".$id);
$students = [];
$studentIds = [];
$allStudents = [];
$allStudentQuery = $db->select("*", "student");

while ($prow = $sp->fetch_array()) {
    $tmp = $db->select("*", "student", "id=".$prow['student_id']);
    while ($p = $tmp->fetch_array()) {
        $students[] = $p;
        $studentIds[] = $p['id'];
    }
}
while ($srow = $allStudentQuery->fetch_array()) {
    $allStudents[] = $srow;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - <?php echo $parent['fname']." ".$parent["ename"]; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="wrapper">
    <h1><?php echo $parent['name']; ?></h1>
    <?php

    if (isset($_POST['id'])) {
        if (isset($_POST['name'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $name = $_POST['name'];
            $stmt = $db->createUpdate(["name"], "parent", "id=?");
            $stmt->bind_param("si", $name, $id);
            $stmt->execute();
        }
        if (isset($_POST['phone_nr'])) {
            //$db->update("ename", "'".$db->escape_string($_POST['ename'])."'", "student", "id=".$db->number_format($_POST['id']));
            $phone_nr = $_POST['phone_nr'];
            $stmt = $db->createUpdate(["phone_nr"], "parent", "id=?");
            $stmt->bind_param("si", $phone_nr, $id);
            $stmt->execute();
        }
        if (isset($_POST['address'])) {
            //$db->update("address", "'".$db->escape_string($_POST['address'])."'", "student", "id=".$db->number_format($_POST['id']));
            $address = $_POST['address'];
            $stmt = $db->createUpdate(["address"], "parent", "id=?");
            $stmt->bind_param("si", $address, $id);
            $stmt->execute();
        }
        if (isset($_POST['email'])) {
            //$db->update("email", "'".$db->escape_string($_POST['email'])."'", "student", "id=".$db->number_format($_POST['id']));
            $email = $_POST['email'];
            $stmt = $db->createUpdate(["email"], "parent", "id=?");
            $stmt->bind_param("si", $email, $id);
            $stmt->execute();
        }
        if (isset($_POST['student'])) {
            $student;

            $insert = $db->createInsert("student_parent", ["parent_id", "student_id"]);
            $insert->bind_param("ii", $id, $student);

            foreach ($_POST['student'] as $student) {
                if (!in_array($student, $studentIds)) {
                    $insert->execute();
                }
            }

            $delete = $db->createDelete("student_parent", "parent_id=? and student_id=?");
            $delete->bind_param("ii", $id, $student);
            foreach ($studentIds as $student) {
                if (!in_array($student, $_POST['student'])) {
                    $delete->execute();
                }
            }

        }
        echo "<h3>Uppdaterad</h3><br>";
        echo "<a class='regular regularBtn' href='index.php?p=updateParent&pid=".$_POST['id']."'>Tillbaka</a>";
    } else {
        include 'update_parent_form.php';
    }

    ?>
</section>
</body>
</html>