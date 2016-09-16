<!DOCTYPE html>
<html>
    <head>
        <title>Nacka Gymnasium</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section id="wrapper">
            <h1>Nacka gymnasium</h1>
            <table>
                <?php
                // Get all students ordered by surname.
                $result = $db->selectOrdered("*", "student", "ename");

                // If there is 1 or more students, iterate through them
                if ($result->num_rows > 0) {
                    // Gen table header
                    echo "<tr class='odd'>";
                    echo "<th>Efternamn</th>";
                    echo "<th colspan='3'>Förnamn</th>";
                    echo "</tr>";

                    // For alternating background
                    $odd = false;

                    //Iterate students.
                    while ($row = $result->fetch_array()) {
                        echo '<tr class="'.($odd ? "odd" : "even").'">';
                        $odd = !$odd;
                        echo "<td>".$row['ename']."</td>";
                        echo "<td>".$row['fname']."</td>";
                        echo '<td class="button" colspan="2"><a href="index.php?p=menu&sid='.$row['id'].'">Åtgärder</a></td>';
                        echo "</tr>";
                    }
                } else { // There is no students.
                    echo "<tr><th>Det finns inga elever</th></tr>";
                }

                ?>
            </table>
        </section>
    </body>
</html>