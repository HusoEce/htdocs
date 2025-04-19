<?php
    include "baglanti.php";
    $sql = "SELECT * FROM admins";
    $sorgu = $db -> query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Mağza</title>
    <link rel="stylesheet" href="Tekno.css">
</head>
<body>
    <div class="navbar">
        <a href="Tekno.php"><img src="img/Logo.png" alt="" style="height:100px;"></a>
        <ul>
            <li><a href="admGrs.php">Admin Giriş Yap</a></li>
        </ul>
    </div>
    <h1 style="margin-left:43%; font-size:40pt;">Hoşgeldiniz</h1><br>
    <div class="container">
        
    </div>
</body>
</html>