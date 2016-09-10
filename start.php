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
                $result = $db->select("*", "student");
                if ($result->num_rows > 0) {
                    echo "<tr class='odd'>";
                    echo "<th colspan='2'>Elev</th>";
                    echo "</tr>";
                    $odd = false;
                    while ($row = $result->fetch_array()) {
                        echo '<tr class="'.($odd ? "odd" : "even").'">';
                        $odd = !$odd;
                        echo "<td>".$row['fname']." ".$row['ename']."</td>";
                        echo '<td class="button"><a href="index.php?p=menu&sid='.$row['id'].'">Åtgärder</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><th>Det finns inga elever</th></tr>";
                }

                ?>
            </table>
        </section>
    </body>
</html>