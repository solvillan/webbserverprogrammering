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
    <form name="choices" action="index.php?p=info&sid=<?php // Insert the requested sid
    if (isset($_GET['sid'])) {
        echo $db->number_format($_GET['sid']);
    } else {
        echo 1;
    }?>" method="post">
        <input type="checkbox" name="parentInfo">Föräldrar</br>
        <input type="checkbox" name="parentContact">Kontaktinformation föräldrar</br>
        <input type="checkbox" name="grades">Omdömmen</br>
        <input type="submit">
    </form>
    <a href="index.php?p=updateStudent&sid=<?php // Insert the requested sid
    if (isset($_GET['sid'])) {
        echo $db->number_format($_GET['sid']);
    } else {
        echo 1;
    }?>">Uppdatera info</a>
</section>
</body>
</html>