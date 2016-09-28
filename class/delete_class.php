<?php
if (!isset($db)) {
    header("Location: index.php?error=".urlencode("deleteClass: Ingen databas är satt."));
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
    header("Location: index.php?error=".urlencode("deleteClass: Inget id är satt."));
    die();
}
$class = $db->select("*", "class", "id=".$id)->fetch_array();
$sc = $db->select("*", "student_class", "class_id=".$id);
$students = [];
$studentIds = [];

while ($prow = $sc->fetch_array()) {
    $tmp = $db->select("*", "student", "id=".$prow['student_id']);
    while ($p = $tmp->fetch_array()) {
        $students[] = $p;
        $studentIds[] = $p['id'];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="backBtn">
    <a href="index.php?p=listClass" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Radera - <?php echo $class['name']?></h1>
    <table>
        <?php
        if (!isset($_POST['pid']) && !isset($_POST['confirm'])) {
            if (!isset($class['id'])) {
                header("Location: index.php?error=".urlencode("deleteClass: Inget id är satt."));
                die();
            }
            echo "<p>Vill du verkligen radera ".$class['name']."?<br>Detta går inte att ångra.</p>";
            echo "<form action='index.php?p=deleteClass' method='post'><table>";
            echo "<tr>";
            echo "<input type='hidden' value='".$class['id']."' name='id'>";
            echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"None\" id=\"slideThree\" name=\"confirm\" /><label for=\"slideThree\"></label></div></td>";
            echo "<td><input class='delete' type='submit' value='Radera!'></td>";
            echo "</tr></table></form>";
            echo "<h3>".$class['name']." har elververna</h3>";
            include 'delete_class_list.php';
        } else {
            $deleteClass = $db->createDelete("class", "id=?");
            $deleteClass->bind_param("i", $id);

            $student;
            $delete = $db->createDelete("student_class", "class_id=? and student_id=?");
            $delete->bind_param("ii", $student, $id);
            foreach ($studentIdsIds as $student) {
                $delete->execute();
            }

            $deleteClass->execute();
            echo "<script>location.href='index.php?p=listParent'</script>";
        }
        ?>
    </table>
</section>
</body>
</html>