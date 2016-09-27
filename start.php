<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="start.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nacka Gymnasium</title>
</head>
<body>

<?php
if (isset($_GET['error'])) {
    echo "<div class='error'>";
    echo "<h3>Ett fel har uppstått!</h3>";
    echo "<p>".$_GET['error']."</p>";
    echo "</div>";
}
?>

<div class="wrapper horizontal">
    <h1 class="banner">Nacka Gymnasium</h1>
    <ul class="menu">
        <li class="item"><a href="index.php?p=listStudent">Elever</a></li>
        <li class="item"><a href="index.php?p=listParent">Föräldrar</a></li>
        <li class="item"><a href="index.php?p=listClass">Ämnen</a></li>
    </ul>
</div>
</body>
</html>