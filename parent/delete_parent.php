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
$parent = $db->select("*", "parent", "id=".$id)->fetch_array();
$sp = $db->select("*", "student_parent", "parent_id=".$id);
$students = [];
$studentIds = [];

while ($prow = $sp->fetch_array()) {
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
    <a href="index.php?p=listParent" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Radera - <?php echo $parent['name'];?></h1>
    <table>
        <?php
        if (!isset($_POST['pid']) && !isset($_POST['confirm'])) {
            if (!isset($parent['id'])) {
                echo "<script>location.href='index.php?p=listParent'</script>";
            }
            echo "<p>Vill du verkligen radera ".$parent['name']."?<br>Detta går inte att ångra.</p>";
            echo "<form action='index.php?p=deleteParent' method='post'><table>";
            echo "<tr>";
            echo "<input type='hidden' value='".$parent['id']."' name='id'>";
            echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"None\" id=\"slideThree\" name=\"confirm\" /><label for=\"slideThree\"></label></div></td>";
            //echo "<td><input class='delete' type='checkbox' name='confirm'></td>";
            echo "<td><input class='delete' type='submit' value='Radera!'></td>";
            echo "</tr></table></form>";
            echo "<h3>".$parent['name']." är förälder till</h3>";
            include 'delete_parent_list.php';
        } else {
            $deleteParent = $db->createDelete("parent", "id=?");
            $deleteParent->bind_param("i", $id);

            $student;
            $delete = $db->createDelete("student_parent", "parent_id=? and student_id=?");
            $delete->bind_param("ii", $id, $student);
            foreach ($studentIds as $student) {
                $delete->execute();
            }

            $deleteParent->execute();
            echo "<script>location.href='index.php?p=listParent'</script>";
        }
        ?>
    </table>
</section>
</body>
</html>