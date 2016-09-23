<?php
if (!isset($class) && !isset($id) && !isset($students) && !isset($allStudents)) {
    echo "<script>location.href='../index.php'</script>";
}
?>


<form action="index.php?p=updateClass" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table class="form">
        <tr>
            <td>Kursnamn</td>
            <td colspan="3"><input type="text" name="name" value="<?php echo $class['name']?>"></td>
        </tr>
        <tr>
            <td>Lärare</td>
            <td colspan="3"><input type="text" name="teacher" value="<?php echo $class['teacher_name']?>"></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Namn</th>
            <th>Address</th>
            <th>Går kursen</th>
            <th>Omdöme</th>
        </tr>
        <?php
        $odd = false;
        foreach ($allStudents as $s) {
            echo "<tr class='".($odd ? "odd" : "even")."'>";
            $odd = !$odd;
            echo "<td>".$s['fname']." ".$s['ename']."</td>";
            echo "<td>".$s['address']."</td>";
            if (in_array($s, $students)) {
                echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"".$s['id']."\" id=\"".$s['id']."\" name=\"student[]\" checked /><label for=\"".$s['id']."\"></label></div></td>";
                //echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'" checked></td>';
            } else {
                echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"".$s['id']."\" id=\"".$s['id']."\" name=\"student[]\" /><label for=\"".$s['id']."\"></label></div></td>";
                //echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'"></td>';
            }
            if (in_array($s, $students)) {
                echo '<td><input type="text" name="grade[]" value="'.$grades[$s['id']].'"></td>';
                echo '<input type="hidden" name="studentId[]" value="'.$s['id'].'">';
            } else {
                echo '<td>Eleven går inte kursen</td>';
            }
            echo "</tr>";
        }
        ?>
    </table>
    <table>
        <tr>
            <td><input class="go" type="submit"></td>
            <td><a class="regular regularBtn" href="index.php">Till listan</a></td>
        </tr></table>
</form>