<?php
    include "baglanti.php";
    $sql1 = "SELECT * FROM Urunler";
    $sql2 = "SELECT * FROM Kullanicilar";

    $sorgusql1 = $db -> query($sql1);
    $sorgusql2 = $db -> query($sql2);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ürünler Tablosu</h1>
    <table border="1">
        <tr>
            <th>Id</th><th>Ürün Adı</th><th>Fiyat</th><th>Miktar</th><th>Marka Adı</th><th>Açıklama</th>
        </tr>

        <?php
            while ($satir = $sorgusql1 -> fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>".$satir["Id"]."</td>";
                echo "<td>".$satir["UrunAdi"]."</td>";
                echo "<td>".$satir["Fiyat"]."</td>";
                echo "<td>".$satir["Miktar"]."</td>";
                echo "<td>".$satir["MarkaAdi"]."</td>";
                echo "<td>".$satir["Aciklama"]."</td>";
                echo "</tr>";
            }
        ?>

    </table>

    
    <h1>Kullanıcılar Tablosu</h1>
    <table border="1">
        <tr>
            <th>Id</th><th>Ad Soyad</th><th>Eposta</th><th>Tel</th><th>TcKimlikNo</th><th>Adres</th>
        </tr>

        <?php
            while ($satir = $sorgusql2 -> fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>".$satir["Id"]."</td>";
                echo "<td>".$satir["AdSoyad"]."</td>";
                echo "<td>".$satir["Eposta"]."</td>";
                echo "<td>".$satir["Tel"]."</td>";
                echo "<td>".$satir["TcKimlikNo"]."</td>";
                echo "<td>".$satir["Adres"]."</td>";
                echo "</tr>";
            }
        ?>

    </table>
</body>
</html>