<?php
if (!isset($db)) {
    header("Location: index.php?error=".urlencode("insertClass: Ingen databas är satt."));
    die();
}
?>

<?php
$allStudents = [];
$allStudentQuery = $db->selectOrdered("*", "student", "ename");

while ($srow = $allStudentQuery->fetch_array()) {
    $allStudents[] = $srow;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - Lägg till student</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="wrapper">
    <h1>Lägg till förälder</h1>
    <?php
        if (isset($_POST['name']) && isset($_POST['teacher']) && isset($_POST['student'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $name = $_POST['name'];
            $teacher = $_POST['teacher'];

            $pid = $db->select("MAX(`id`)", "class")->fetch_array()['MAX(`id`)'] + 1;

            $stmt = $db->createInsert("class", ["name", "teacher_name"]);
            $stmt->bind_param("ss", $name, $teacher);
            $stmt->execute();

            $student;
            $tmp = "Ej satt";

            $insert = $db->createInsert("student_class", ["class_id", "student_id", "grade"]);
            $insert->bind_param("iis", $id, $student, $tmp);

            foreach ($_POST['student'] as $student) {
                $insert->execute();
            }

            echo "<h3>Uppdaterad</h3><br>";
            echo "<a class='regularBtn regular' href='index.php'>Tillbaka</a>";
    } else {
        include 'insert_class_form.php';
    }

    ?>
</section>
</body>
</html>