<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For-Schleife</title>
</head>
<body>
    <h1>For-Schleifen</h1>

    <?php

        echo "<table border='1'>";
        echo "<tr>";
        for ($i=1; $i <= 10; $i++) { 
            echo "<td>";
            echo $i;
            echo "</td>";
        }
        echo "</tr>";
        echo "</table>";

        //Mal Tabelle ausgeben
        
        echo "<h1>Mal Tabelle</h1><br/>";
        echo "<table border='1'>";
        for ($i=1; $i <= 10; $i++) {
            if ($i==6) continue;
            echo "<tr>";
            for ($j=1; $j <= 10; $j++) { 
                echo "<td>";
                $number = $j * $i;
                //Alle durch 7 teilbare Zahlen ausblenden
                if ($number % 7 != 0) echo $number;
                else echo "...";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

    ?>

    <br/>
    <table border="1">
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
        </tr>
        <tr>
            <td>2</td>
            <td>4</td>
            <td>6</td>
        </tr>
        <tr>
            <td>3</td>
            <td>6</td>
            <td>9</td>
        </tr>
    </table>

</body>
</html>