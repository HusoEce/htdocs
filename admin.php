<?php
session_start();
include "baglanti.php";
if (!isset($_SESSION["admin_giris"]) || $_SESSION["admin_giris"] !== true) {
    header("Location: admGrs.php");
    exit();
}

$sql = "SELECT * FROM urunler";
$sorgu = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Admin</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="navbar">
        <a href="#"><img src="img/Logo.png" alt="" style="height:100px;"></a>
        <ul>
            <li><a href="logout.php">Çıkış Yap</a></li>
            <li><a href="adminKyt.php">Kayıt Yap</a></li>
        </ul>
    </div>
    <div class="container">

        <form action="" method="post" style="margin-top:-200px;">
            <table>
                <tr><th colspan="2" style="font-size:60px;">Ürün Ekleme</th></tr>
                <tr><td>Ürün Adı :</td><td><input type="text" name="isim" style="width:150px; font-size:40px;"></td></tr><br>
                <tr><td>Fiyat :</td><td><input type="text" name="Fiyat" style="width:150px; font-size:40px;"></td></tr><br>
                <tr><td>Miktar :</td><td><input type="text" name="Miktar" style="width:150px; font-size:40px;"></td></tr><br>
                <tr><td>Görsel :</td><td><input type="file" name="gorsel" style="width:300px; font-size:20px;"></td></tr><br>
                <tr><td><input type="submit" value="Kaydet" name="Kaydet" style="width:150px; font-size:40px;"></td>
                <td><input type="submit" value="Sıfırla" name="Sifirla" style="width:150px; font-size:40px;"></td></tr><br>
            </table>
        </form><br>

        <?php
                if (isset($_POST["Kaydet"])) {
                    $isim = trim($_POST["isim"]);
                    $fiyat = trim($_POST["Fiyat"]);
                    $miktar = trim($_POST["Miktar"]);
                    $gorsel = trim($_POST["gorsel"]);

                    $kaydet1 = $db->prepare("INSERT INTO `urunler`(`ID`, `isim`, `miktar`, `fiyat`, `gorsel`) VALUES (NULL, :isim, :miktar, :fiyat, :gorsel)");
                    $kaydet1->bindParam(":isim", $isim, PDO::PARAM_STR);
                    $kaydet1->bindParam(":fiyat", $fiyat, PDO::PARAM_STR);
                    $kaydet1->bindParam(":miktar", $miktar, PDO::PARAM_INT);
                    $kaydet1->bindParam(":gorsel", $gorsel, PDO::PARAM_STR);

                    $ekle1 = $kaydet1->execute();
                    if ($ekle1) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                }
            if (isset($_POST["Sifirla"])) {
                $sifirla1 = $db->prepare("TRUNCATE TABLE urunler; ALTER TABLE urunler AUTO_INCREMENT = 1;");
                $sifir1 = $sifirla1->execute();
                if ($sifir1) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
            }
        ?>
        <h1>Ürünler Tablosu</h1>
        <table border="1">
            <tr>
                <th>Id</th><th>İsim</th><th>Fiyat</th><th>Miktar</th><th>Foto Url</th>
            </tr>
            <?php
                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$satir["ID"]."</td>";
                    echo "<td>".$satir["isim"]."</td>";
                    echo "<td>".$satir["fiyat"]."</td>";
                    echo "<td>".$satir["miktar"]."</td>";
                    echo "<td><img src="."img/".$satir["gorsel"]." style='height:100px;'></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
