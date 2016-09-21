<?php
if (!isset($db)) {
    echo "<script>location.href='index.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - Meny</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="wrapper">
    <h1>Välj åtgärd</h1>
    <form name="choices" action="public/index.php?p=info&sid=<?php // Insert the requested sid
    if (isset($_GET['sid'])) {
        echo $db->number_format($_GET['sid']);
    } else {
        echo 1;
    }?>" method="post">
        <table>
            <tr class="odd">
                <td>Föräldrar</td>
                <td>
                    <div class="slideThree">
                        <input type="checkbox" id="parentInfo" name="parentInfo"/>
                        <label for="parentInfo"></label>
                    </div>
                </td>
            </tr>
            <tr class="even">
                <td>Kontaktinformation Föräldrar</td>
                <td>
                    <div class="slideThree">
                        <input type="checkbox" id="parentContact" name="parentContact"/>
                        <label for="parentContact"></label>
                    </div>
                </td>
            </tr>
            <tr class="odd">
                <td>Omdömen</td>
                <td>
                    <div class="slideThree">
                        <input type="checkbox" id="grades" name="grades"/>
                        <label for="grades"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input class="go" type="submit"></td>
                <td ><a class="regular regularBtn" href="public/index.php?p=updateStudent&sid=<?php // Insert the requested sid
                    if (isset($_GET['sid'])) {
                        echo $db->number_format($_GET['sid']);
                    } else {
                        echo 1;
                    }?>">Uppdatera info</a></td>
            </tr>
        </table>
        <!--<input type="checkbox" name="parentInfo">Föräldrar</br>
        <input type="checkbox" name="parentContact">Kontaktinformation föräldrar</br>
        <input type="checkbox" name="grades">Omdömmen</br>-->
    </form>

</section>
</body>
</html>