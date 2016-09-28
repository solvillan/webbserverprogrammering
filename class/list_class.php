<?php
if (!isset($db)) {
    header("Location: index.php?error=".urlencode("listClass: Ingen databas är satt."));
    die();
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
    <a href="index.php" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Nacka gymnasium - Föräldrar</h1>
    <table class="list">
        <?php
        // Get all students ordered by surname.
        $result = $db->selectOrdered("*", "class", "name");

        // If there is 1 or more students, iterate through them
        if ($result->num_rows > 0) {
            // Gen table header
            echo "<tr class='odd'>";
            echo "<th>Namn</th>";
            echo "<th>Lärare</th>";
            echo "<th colspan='2' class='button'>Åtgärder</th>";
            echo "</tr>";

            // For alternating background
            $odd = false;

            //Iterate students.
            while ($row = $result->fetch_array()) {
                echo '<tr class="'.($odd ? "odd" : "even").'">';
                $odd = !$odd;
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['teacher_name']."</td>";
                echo '<td class="" ><a class="go goBtn" href="index.php?p=updateClass&cid='.$row['id'].'">Uppdatera</a></td>';
                echo '<td class="" ><a class="delete deleteBtn" href="index.php?p=deleteClass&cid='.$row['id'].'">Radera</a></td>';
                echo "</tr>";
            }
        } else { // There is no students.
            echo "<tr><th>Det finns inga kurser</th></tr>";
        }

        ?>
    </table>
</section>
<div class="hover footer">
    <a href="index.php?p=insertClass" class="go goBtn p50">Lägg till</a>
</div>
</body>
</html>