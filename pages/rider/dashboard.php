<?php
session_start();
if(!isset($_SESSION['role'])||$_SESSION['role']!=="rider"){
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        rider
    </h1>
</body>
</html>