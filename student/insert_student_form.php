<form action="index.php?p=insertStudent" method="post">
    <table class="form">
        <tr>
            <td>Förnamn</td>
            <td><input required type="text" name="fname" value=""></td>
        </tr>
        <tr>
            <td>Efternamn</td>
            <td><input required type="text" name="ename" value=""></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td><input required type="text" name="address" value=""></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input required type="email" name="email" value=""></td>
        </tr>
        <tr>
            <td><input class="go" type="submit"></td>
            <td><a class="regular regularBtn" href="index.php?p=listStudent">Till listan</a></td>
        </tr>
    </table>
</form>