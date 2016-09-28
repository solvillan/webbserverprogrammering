<?php
if (!isset($db)) {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nacka Gymnasium - Lägg till student</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="backBtn">
    <a href="index.php?p=listStudent" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Lägg till student</h1>
    <?php
        if (isset($_POST['fname']) && isset($_POST['ename']) && isset($_POST['address']) && isset($_POST['email'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $fname = $_POST['fname'];
            $ename = $_POST['ename'];
            $address = $_POST['address'];
            $email = $_POST['email'];

            $stmt = $db->createInsert("student", ["fname", "ename", "address", "email"]);
            $stmt->bind_param("ssss", $fname, $ename, $address, $email);
            $stmt->execute();
            echo "<h3>Uppdaterad</h3><br>";
            echo "<a class='regular regularBtn' href='index.php?p=listStudent'>Tillbaka</a>";
    } else {
        include 'insert_student_form.php';
    }

    ?>
</section>
</body>
</html>