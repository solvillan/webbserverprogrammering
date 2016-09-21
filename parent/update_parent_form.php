<?php
if (!isset($parent) && !isset($id) && !isset($students) && !isset($allStudents)) {
    echo "<script>location.href='../index.php'</script>";
}
?>


<form action="../index.php?p=updateParent" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table>
        <tr>
            <td>Förnamn</td>
            <td colspan="3"><input type="text" name="name" value="<?php echo $parent['name']?>"></td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td colspan="3"><input type="text" name="phone_nr" value="<?php echo $parent['phone_nr']?>"></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td colspan="3"><input type="text" name="address" value="<?php echo $parent['address']?>"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td colspan="3"><input type="email" name="email" value="<?php echo $parent['email']?>"></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Namn</th>
            <th>Address</th>
            <th>Förälder till</th>
        </tr>
        <?php
        $odd = false;
        foreach ($allStudents as $s) {
            echo "<tr class='".($odd ? "odd" : "even")."'>";
            $odd = !$odd;
            echo "<td>".$s['fname']." ".$s['ename']."</td>";
            echo "<td>".$s['address']."</td>";
            if (in_array($s, $students)) {
                echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'" checked></td>';
            } else {
                echo '<td><input type="checkbox" name="student[]" value="'.$s['id'].'"></td>';
            }
            echo "</tr>";
        }
        ?>
    </table>
    <table>
        <tr>
            <td><input type="submit"></td>
            <td><a href="../index.php">Till listan</a></td>
        </tr></table>
</form>