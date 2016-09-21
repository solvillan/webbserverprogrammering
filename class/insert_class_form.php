<?php
if (!isset($id)) {
    echo "<script>location.href='../index.php'</script>";
}
?>

<form action="../public/index.php?p=insertParent" method="post">
    <input type="hidden" name="sid" value="<?php echo $id?>">
    <table>
        <tr>
            <td>Namn</td>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td><input type="text" name="phone_nr" value=""></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td><input type="text" name="address" value=""></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="email" name="email" value=""></td>
        </tr>
        <tr>
            <td><input type="submit"></td>
            <td><a href="../public/index.php">Till listan</a></td>
        </tr>
    </table>
</form>