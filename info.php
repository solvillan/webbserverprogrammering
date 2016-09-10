<?php
    // Init vars
    if (isset($_GET['sid'])) {
        $id = $_GET['sid'];
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
    <title>Nacka Gymnasium - </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="wrapper">
    <h1><?php echo $student['fname']." ".$student["ename"]; ?></h1>
    <?php
        if (isset($_POST['parentInfo']) || isset($_POST['parentContact'])) {
            echo "<h4>Föräldrar</h4>";
            echo "<table>";
            echo "<tr class='odd'>";
            if (isset($_POST['parentInfo'])) echo "<th>Namn</th>";
            if (isset($_POST['parentContact'])) {
                echo "<th>Adress</th><th>E-mail</th><th>Telefon</th>";
            }
            echo "</tr>";
            $odd = false;
            foreach ($parents as $parent) {
                echo '<tr class="'.($odd ? "odd" : "even").'">';
                $odd = !$odd;
                if (isset($_POST['parentInfo'])) echo "<td>" . $parent['name'] . "</td>";
                if (isset($_POST['parentContact'])) {
                    echo "<td>" . $parent['address'] . "</td>";
                    echo "<td>" . $parent['email'] . "</td>";
                    echo "<td>" . $parent['phone_nr'] . "</td>";
                }
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
        if (isset($_POST['grades'])) {
            echo "<h4>Kurser</h4>";
            echo "<table>";
            echo "<tr class='odd'>";
            echo "<th>Kurs</th><th>Lärare</th><th>Omdöme</th>";
            echo "</tr>";
            $odd = false;
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
    if (!isset($_POST['parentInfo']) && !isset($_POST['parentContact']) && !isset($_POST['grades'])) {
        echo "<h3>Inga alternativ valda</h3>";
    }
    ?>
</section>
</body>
</html>