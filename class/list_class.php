<?php
if (!isset($db)) {
    echo "<script>location.href='index.php'</script>";
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
<section id="wrapper">
    <h1>Nacka gymnasium - Föräldrar</h1>
    <table>
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
</body>
</html>