<?php
if (!isset($db)) {
    echo "<script>location.href='../index.php'</script>";
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
$allStudentQuery = $db->select("*", "student");
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

            $insert = $db->createInsert("student_class", ["class_id", "student_id"]);
            $insert->bind_param("ii", $id, $student);

            foreach ($_POST['student'] as $student) {
                if (!in_array($student, $studentIds)) {
                    $insert->execute();
                }
            }

            $delete = $db->createDelete("student_class", "parent_id=? and student_id=?");
            $delete->bind_param("ii", $id, $student);
            foreach ($studentIds as $student) {
                if (!in_array($student, $_POST['student'])) {
                    $delete->execute();
                }
            }

        }
        echo "<h3>Uppdaterad</h3><br>";
        echo "<a href='index.php?p=updateClass&cid=".$_POST['id']."'>Tillbaka</a>";
    } else {
        include 'update_class_form.php';
    }

    ?>
</section>
</body>
</html>