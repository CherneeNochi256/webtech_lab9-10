<?php
$rows = 10;

$cols = 10;

for ($tr = 1; $tr <= $rows; $tr++) {

    echo "<table  border='1' >";

    echo "<tr>";

    for ($td = 1; $td <= $cols; $td++) {
        $value = $tr * $td;
        echo "<td width='30px' height='30px'>&ensp;$value</td>";

    }

    echo "</tr>";

}

echo "</table>";
