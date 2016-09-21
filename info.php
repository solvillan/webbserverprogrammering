<?php
if (!isset($db)) {
    echo "<script>location.href='index.php?p=info'</script>";
}
?>
<?php
    // Init vars
    if (isset($_GET['sid']) && $_GET['sid'] != "") {
        $id = $db->number_format($_GET['sid']);
    } else {
        $id = 1;
    }
    $parent = $db->select("*", "student", "id=".$id)->fetch_array();
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
    <title>Nacka Gymnasium - <?php echo $parent['fname']." ".$parent["ename"]; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="wrapper">
    <h1><?php echo $parent['fname']." ".$parent["ename"]; ?></h1>
    <?php
        if (isset($_POST['parentInfo']) || isset($_POST['parentContact'])) {
            echo "<h4>Föräldrar - <a href='index.php?p=insertParent&sid=".$id."'>Lägg till</a></h4>";
            echo "<table>";

            //Table header
            echo "<tr class='odd'>";
            if (isset($_POST['parentInfo']))  {
                if (!isset($_POST['parentContact'])) {
                    echo "<th colspan='2'>Namn</th>";
                } else {
                    echo "<th>Namn</th>";
                }
            }
            if (isset($_POST['parentContact'])) {
                echo "<th>Adress</th><th>E-mail</th><th colspan='2'>Telefon</th>";
            }
            echo "</tr>";

            // For alternation
            $odd = false;

            // Iterate through parents
            foreach ($parents as $parent) {
                echo '<tr class="'.($odd ? "odd" : "even").'">';
                $odd = !$odd;
                if (isset($_POST['parentInfo'])) echo "<td>" . $parent['name'] . "</td>";
                if (isset($_POST['parentContact'])) {
                    echo "<td>" . $parent['address'] . "</td>";
                    echo "<td>" . $parent['email'] . "</td>";
                    echo "<td>" . $parent['phone_nr'] . "</td>";
                }
                echo "<td><a href='index.php?p=updateParent&pid=" . $parent['id']. "'>Uppdatera</a></td>";
                echo "</tr>";
            }
            if (count($parents) == 0) {
                echo '<tr class="'.($odd ? "odd" : "even").'">';
                echo '<td colspan="4">Eleven har inga registrerade föräldrar.</td>';
                echo '</tr>';
            }
            echo "</table>";
        }
    ?>
    <?php
        // Show classes and grades
        if (isset($_POST['grades'])) {
            echo "<h4>Kurser</h4>";
            echo "<table>";
            echo "<tr class='odd'>";
            echo "<th>Kurs</th><th>Lärare</th><th>Omdöme</th>";
            echo "</tr>";

            // For alternation
            $odd = false;

            // Itereate classes
            foreach ($classes as $class) {
                echo '<tr class="'.($odd ? "odd" : "even").'">';
                $odd = !$odd;
                echo "<td>" . $class['name'] . "</td>";
                echo "<td>" . $class['teacher_name'] . "</td>";
                echo "<td>" . $grades[$class['id']] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
    <?php
    // If no options, display error
    if (!isset($_POST['parentInfo']) && !isset($_POST['parentContact']) && !isset($_POST['grades'])) {
        echo "<h3>Inga alternativ valda</h3>";
    }
    ?>
</section>
</body>
</html>