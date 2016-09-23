<?php
if (!isset($allStudents)) {
    echo "<script>location.href='../index.php'</script>";
}
?>

<form action="index.php?p=insertClass" method="post">
    <table class="form">
        <tr>
            <td>Kursnamn</td>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td>Lärare</td>
            <td><input type="text" name="teacher" value=""></td>
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
            <td><input type="submit"></td>
            <td><a href="index.php">Till listan</a></td>
        </tr>
    </table>
</form>