<?php
if (!isset($student) && !isset($id)) {
    echo "<script>location.href='../index.php'</script>";
}
?>


<form action="../index.php?p=updateStudent" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table>
        <tr>
            <td>Förnamn</td>
            <td><input type="text" name="fname" value="<?php echo $student['fname']?>"></td>
        </tr>
        <tr>
            <td>Efternamn</td>
            <td><input type="text" name="ename" value="<?php echo $student['ename']?>"></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td><input type="text" name="address" value="<?php echo $student['address']?>"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="email" name="email" value="<?php echo $student['email']?>"></td>
        </tr>
        <tr>
            <td><input type="submit"></td>
            <td><a href="../index.php">Till listan</a></td>
        </tr>
    </table>
</form>