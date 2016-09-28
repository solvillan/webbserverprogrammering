<?php
if (!isset($students)) {
    header("Location: index.php");
    die();
}
?>

<table>
    <tr>
        <th>Namn</th>
        <th>Address</th>
    </tr>
    <?php
    $odd = false;
    foreach ($students as $s) {
        echo "<tr class='".($odd ? "odd" : "even")."'>";
        $odd = !$odd;
        echo "<td>".$s['fname']." ".$s['ename']."</td>";
        echo "<td>".$s['address']."</td>";
    }
    ?>
</table>