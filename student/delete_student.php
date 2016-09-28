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
    header("Location: index.php");
    die();
}
$student = $db->select("*", "student", "id=".$id)->fetch_array();
$sp = $db->select("*", "student_parent", "student_id=".$id);
$parents = [];
$parentIds = [];

while ($prow = $sp->fetch_array()) {
    $tmp = $db->select("*", "student", "id=".$prow['parent_id']);
    while ($p = $tmp->fetch_array()) {
        $parents[] = $p;
        $parentIds[] = $p['id'];
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
    <a href="index.php?p=listStudent" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Radera - <?php echo $student['fname']." ".$student['ename'];?></h1>
    <table>
        <?php
        if (!isset($_POST['pid']) && !isset($_POST['confirm'])) {
            if (!isset($student['id'])) {
                header("Location: index.php");
                die();
            }
            echo "<p>Vill du verkligen radera ".$student['fname']." ".$student['ename']."?<br>Detta går inte att ångra.</p>";
            echo "<form action='index.php?p=deleteStudent' method='post'><table>";
            echo "<tr>";
            echo "<input type='hidden' value='".$student['id']."' name='id'>";
            echo "<td><input type='checkbox' name='confirm'> Ja, radera ".$student['fname']." ".$student['ename']."</td>";
            echo "<td><input class='delete' type='submit' value='Radera!'></td>";
            echo "</tr></table></form>";
            echo "<h3>".$student['fname']." ".$student['ename']." är barn till</h3>";
            include 'delete_student_list.php';
        } else {
            $deleteStudent = $db->createDelete("student", "id=?");
            $deleteStudent->bind_param("i", $id);

            $parent;
            $delete = $db->createDelete("student_parent", "parent_id=? and student_id=?");
            $delete->bind_param("ii", $parent, $id);
            foreach ($parentIds as $parent) {
                $delete->execute();
            }

            $deleteStudent->execute();
            echo "<script>location.href='index.php?p=listParent'</script>";
        }
        ?>
    </table>
</section>
</body>
</html>