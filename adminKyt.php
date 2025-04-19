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
    <title>TechnoCastle - Admin Liste</title>
    <link rel="stylesheet" href="adminKyt.css">
</head>
<body>
    <div class="navbar">
        <a href="admin.php"><img src="img/Logo.png" alt="" style="height:100px;"></a>
        <ul>
            <li><a href="admin.php">Admin Sekmesine Dön</a></li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="post" style="margin-top:-200px;">
            <table>
                <tr><th colspan="2" style="font-size:60px;">Admin Ekle</th></tr>
                <tr><td>Kullanıcı Adı :</td><td><input type="text" name="ad" style="width:150px; font-size:40px;" required></td></tr><br>
                <tr><td>Şifre :</td><td><input type="text" name="sifre" style="width:150px; font-size:40px;" required></td></tr><br>
                <tr><td><input type="submit" value="Kaydet" name="Kaydet" style="width:150px; font-size:40px;"></td>
                <td><input type="submit" value="Sil" name="Sil" style="width:150px; font-size:40px;"></td></tr><br>
            </table>
        </form><br>

        <?php
            if (isset($_POST["Kaydet"])) {
                $klncad = trim($_POST["ad"]);
                $klncsfr = trim($_POST["sifre"]);
                $kaydet1 = $db->prepare("INSERT INTO `admins`(`ad`, `sifre`) VALUES (:ad, :sifre)");
                $kaydet1->bindParam(":ad", $klncad, PDO::PARAM_STR);
                $kaydet1->bindParam(":sifre", $klncsfr, PDO::PARAM_STR);

                $ekle1 = $kaydet1->execute();
                if ($ekle1) {
                    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                }
            }

            if (isset($_POST["Sil"])) {
                $klncad = trim($_POST["ad"]);
                if($klncad !== "Zero"){
                    $sl1 = $db->prepare('DELETE FROM `admins` WHERE ad = :ad');
                    $sl1->bindParam(":ad", $klncad, PDO::PARAM_STR);
                    $sifir1 = $sl1->execute();
                    if ($sifir1) {
                        echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                    }
                }
                else if ($klncad == "Zero") {
                    echo "<script type='text/javascript'>alert('Ana Admini Silme İşlemi Denemeniz Başarısız Bunu Yapamazsınız!!');</script>";
                    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                }
            }
        ?>

        <h1>Admin Tablosu</h1>
        <table border="1">
            <tr>
                <th>Sıra</th><th>kullanıcı Adı</th><th>Sifre</th>
            </tr>
            <?php
            $sira = 0;
                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$sira++."</td>";
                    echo "<td>".$satir["ad"]."</td>";
                    echo "<td>".$satir["sifre"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>