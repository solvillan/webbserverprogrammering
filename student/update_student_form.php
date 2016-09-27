<?php
if (!isset($student) || !isset($id)) {
    header("Location: index.php");
    die();
}
?>


<form action="index.php?p=updateStudent" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table class="form">
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
            <td><input class="go" type="submit"></td>
            <td><a class="regular regularBtn" href="index.php?p=listStudent">Till listan</a></td>
        </tr>
    </table>
</form>