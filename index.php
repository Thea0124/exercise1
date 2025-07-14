<?php
    $price = 5;
    echo "<table border ='1' class = 'w-[60%] h[40px]'>";
    echo "<tr><th>QTY</th><th>Total</th></tr>";
    for($i = 10;$i <=100;$i=$i+10){
    echo "<tr>
            <td>$i</td>
            <td>".$i * $price."</td>
        </tr>";
    }
    echo "</table>";
?>