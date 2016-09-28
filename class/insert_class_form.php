<?php
if (!isset($allStudents)) {
    header("Location: index.php?error=".urlencode("insertClass: allStudents är inte satt."));
    die();
}
?>

<form action="index.php?p=insertClass" method="post">
    <table class="form">
        <tr>
            <td>Kursnamn</td>
            <td><input required type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td>Lärare</td>
            <td><input required type="text" name="teacher" value=""></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Namn</th>
            <th>Address</th>
            <th>Går kursen</th>
        </tr>
        <?php
        $odd = false;
        foreach ($allStudents as $s) {
            echo "<tr class='".($odd ? "odd" : "even")."'>";
            $odd = !$odd;
            echo "<td>".$s['fname']." ".$s['ename']."</td>";
            echo "<td>".$s['address']."</td>";
            echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"".$s['id']."\" id=\"".$s['id']."\" name=\"student[]\" /><label for=\"".$s['id']."\"></label></div></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <table>
        <tr>
            <td><input class="go goBtn" type="submit"></td>
            <td><a class="regular regularBtn" href="index.php">Till listan</a></td>
        </tr>
    </table>
</form>