<?php
if (!isset($db)) {
    header("Location: index.php?error=".urlencode("updateClass: Ingen databas är satt."));
    die();
}
?>

<?php
// Init vars
if (isset($_GET['cid']) && $_GET['cid'] != "") {
    $id = $db->number_format($_GET['cid']);
} else if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $db->number_format($_POST['id']);
} else {
    $id = 1;
}
$class = $db->select("*", "class", "id=".$id)->fetch_array();
$sc = $db->select("*", "student_class", "class_id=".$id);
$students = [];
$studentIds = [];
$allStudents = [];
$allStudentQuery = $db->selectOrdered("*", "student", "ename");
$grades = [];

while ($prow = $sc->fetch_array()) {
    $tmp = $db->select("*", "student", "id=".$prow['student_id']);
    while ($p = $tmp->fetch_array()) {
        $students[] = $p;
        $studentIds[] = $p['id'];
        $grades[$p['id']] = $prow['grade'];
    }
}
while ($srow = $allStudentQuery->fetch_array()) {
    $allStudents[] = $srow;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - <?php echo $class['name']; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="backBtn">
    <a href="index.php?p=listClass" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1><?php echo $class['name']; ?></h1>
    <?php

    if (isset($_POST['id'])) {
        if (isset($_POST['name'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $name = $_POST['name'];
            $stmt = $db->createUpdate(["name"], "class", "id=?");
            $stmt->bind_param("si", $name, $id);
            $stmt->execute();
        }
        if (isset($_POST['teacher'])) {
            //$db->update("ename", "'".$db->escape_string($_POST['ename'])."'", "student", "id=".$db->number_format($_POST['id']));
            $phone_nr = $_POST['teacher'];
            $stmt = $db->createUpdate(["teacher_name"], "class", "id=?");
            $stmt->bind_param("si", $phone_nr, $id);
            $stmt->execute();
        }
        if (isset($_POST['student'])) {
            $student;
            $tmp = "-";

            $insert = $db->createInsert("student_class", ["class_id", "student_id", "grade"]);
            $insert->bind_param("iis", $id, $student, $tmp);

            foreach ($_POST['student'] as $student) {
                if (!in_array($student, $studentIds)) {
                    $insert->execute();
                }
            }

            $delete = $db->createDelete("student_class", "class_id=? and student_id=?");
            $delete->bind_param("ii", $id, $student);
            foreach ($studentIds as $student) {
                if (!in_array($student, $_POST['student'])) {
                    $delete->execute();
                }
            }
            if (isset($_POST['grade']) && isset($_POST['studentId'])) {
                $update = $db->createUpdate(["grade"], "student_class", "student_id=? and class_id=?");
                $studentId;
                $grade;
                $update->bind_param("sii", $grade, $studentId, $id);

                for ($i = 0; $i < count($_POST['grade']); $i++) {
                    $grade = $_POST['grade'][$i];
                    $studentId = $_POST['studentId'][$i];
                    $update->execute();
                }

            }
        }
        echo "<h3>Uppdaterad</h3><br>";
        echo "<a class='regular regularBtn' href='index.php?p=updateClass&cid=".$_POST['id']."'>Tillbaka</a>";
    } else {
        include 'update_class_form.php';
    }

    ?>
</section>
</body>
</html>