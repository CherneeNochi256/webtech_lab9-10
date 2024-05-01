<?php
echo '<table border=1>';
for ($i=0; $i<=255; $i += 50)
{
    echo '<tr>';

    for ($j=0; $j<=255; $j += 50)
    {
        for ($k=0; $k<=255; $k += 50)
        {
            echo '<td style="background-color:RGB('.$i.', '.$j.', '.$k.');"> rgb('.$i.', '.$j.', '.$k.')</td>';
        }
    }

    echo '</tr>';
}
echo'</table>';
