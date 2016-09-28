<?php
if (!isset($parent) || !isset($id) || !isset($students) || !isset($allStudents)) {
    header("Location: index.php?error=".urlencode("updateParent: Variablerna är inte satta."));
    die();
}
?>


<form action="index.php?p=updateParent" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table class="form">
        <tr>
            <td>Förnamn</td>
            <td colspan="3"><input required type="text" name="name" value="<?php echo $parent['name']?>"></td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td colspan="3"><input required type="text" name="phone_nr" value="<?php echo $parent['phone_nr']?>"></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td colspan="3"><input required type="text" name="address" value="<?php echo $parent['address']?>"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td colspan="3"><input required type="email" name="email" value="<?php echo $parent['email']?>"></td>
        </tr>
    </table>
    <table class="list">
        <tr>
            <th>Namn</th>
            <!--<th>Address</th>-->
            <th>Förälder till</th>
        </tr>
        <?php
        $odd = false;
        foreach ($allStudents as $s) {
            echo "<tr class='".($odd ? "odd" : "even")."'>";
            $odd = !$odd;
            echo "<td>".$s['fname']." ".$s['ename']."</td>";
            //echo "<td>".$s['address']."</td>";
            if (in_array($s, $students)) {
                echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"".$s['id']."\" id=\"".$s['id']."\" name=\"student[]\" checked /><label for=\"".$s['id']."\"></label></div></td>";
                //echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'" checked></td>';
            } else {
                echo "<td><div class=\"slideThree\"><input type=\"checkbox\" value=\"".$s['id']."\" id=\"".$s['id']."\" name=\"student[]\" /><label for=\"".$s['id']."\"></label></div></td>";
                //echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'"></td>';
            }
            echo "</tr>";
        }
        ?>
    </table>
    <table class="hover footer">
        <tr>
            <td><input type="submit" class="go"></td>
            <td><a class="regular regularBtn" href="index.php?p=listParent">Till listan</a></td>
        </tr></table>
</form>