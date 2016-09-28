<?php
if (!isset($db)) {
    header("Location: index.php?error=".urlencode("updateParent: Ingen databas är satt."));
    die();
}
if (isset($_GET['sid']) && $_GET['sid'] != "") {
    $id = $db->number_format($_GET['sid']);
} else if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $db->number_format($_POST['id']);
} else {
    $id = 1;
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
    <a href="index.php?p=listParent" class="">&nbsp;</a>
</div>
<section id="wrapper">
    <h1>Lägg till förälder</h1>
    <?php
        if (isset($_POST['name']) && isset($_POST['phone_nr']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['sid'])) {
            //$db->update("fname", "'".$db->escape_string($_POST['fname'])."'", "student", "id=".$db->number_format($_POST['id']));
            $fname = $_POST['name'];
            $phone_nr = $_POST['phone_nr'];
            $address = $_POST['address'];
            $email = $_POST['email'];

            $sid = $_POST['sid'];
            $pid = $db->select("MAX(`id`)", "parent")->fetch_array()['MAX(`id`)'] + 1;

            $stmt = $db->createInsert("parent", ["name", "phone_nr", "address", "email"]);
            $stmt->bind_param("ssss", $fname, $phone_nr, $address, $email);
            $stmt->execute();

            $stmt = $db->createInsert("student_parent", ["student_id", "parent_id"]);
            $stmt->bind_param("ii", $sid, $pid);
            $stmt->execute();

            echo "<h3>Uppdaterad</h3><br>";
            echo "<a class='regular regularBtn' href='index.php?=listParent'>Tillbaka</a>";
    } else {
        include 'insert_parent_form.php';
    }

    ?>
</section>
</body>
</html>