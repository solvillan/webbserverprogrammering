<?php
if (!isset($id)) {
    echo "<script>location.href='../index.php'</script>";
}
?>

<form action="index.php?p=insertParent" method="post">
    <input type="hidden" name="sid" value="<?php echo $id?>">
    <table class="form">
        <tr>
            <td>Namn</td>
            <td><input type="text" name="name" value="" required></td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td><input type="text" name="phone_nr" value="" required></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td><input type="text" name="address" value="" required></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="email" name="email" value="" required></td>
        </tr>
        <tr>
            <td><input class="go" type="submit"></td>
            <td><a class="regular regularBtn" href="index.php?p=listParent">Till listan</a></td>
        </tr>
    </table>
</form>