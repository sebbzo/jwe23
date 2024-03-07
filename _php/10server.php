<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superglobale Variablen</title>
</head>
<body>

<?php

echo "<h1>superglobal veriables in PHP</h1><br/>";

echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<pre>";
print_r($_SERVER);
echo "</pre>";

?>
    
</body>
</html>