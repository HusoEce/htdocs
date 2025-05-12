<?php
    include "baglanti.php";  // Veritabanı bağlantısı için 'baglanti.php' dosyasını dahil ediyoruz
    $sql = "SELECT * FROM admins";  // 'admins' tablosundaki tüm verileri seçiyoruz
    $sorgu = $db -> query($sql);  // SQL sorgusunu çalıştırıyoruz
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Admin Liste</title>
    <link rel="stylesheet" href="adminKyt.css">  <!-- Admin panelinin stil dosyasını bağlıyoruz -->
    <link rel="shortcut icon" href="img/logos/favicon.ico" type="image/x-icon">  <!-- Favicon ekliyoruz -->
</head>
<body>
    <div class="navbar">
        <a href="admin.php"><img src="img/logos/Logo.png" alt="" style="height:100px;"></a>
        <ul>
            <li><a href="admin.php">Admin Sekmesine Dön</a></li>  <!-- Admin paneline dönüş linki -->
        </ul>
    </div>

    <div class="container">
        <!-- Admin Ekleme Formu -->
        <form action="" method="post" style="margin-top:-200px;">
            <table>
                <tr><th colspan="2" style="font-size:60px;">Admin Ekle</th></tr>  <!-- Başlık -->
                <tr><td>Kullanıcı Adı :</td><td><input type="text" name="ad" style="width:150px; font-size:40px;" required></td></tr><br>  <!-- Kullanıcı adı inputu -->
                <tr><td>Şifre :</td><td><input type="text" name="sifre" style="width:150px; font-size:40px;" required></td></tr><br>  <!-- Şifre inputu -->
                <tr><td><input type="submit" value="Kaydet" name="Kaydet" style="width:150px; font-size:40px;"></td>  <!-- Kaydet butonu -->
                <td><input type="submit" value="Sil" name="Sil" style="width:150px; font-size:40px;"></td></tr><br>  <!-- Sil butonu -->
            </table>
        </form><br>

        <?php
            // Admin Ekleme İşlemi
            if (isset($_POST["Kaydet"])) {
                $klncad = trim($_POST["ad"]);  // Kullanıcı adını al
                $klncsfr = trim($_POST["sifre"]);  // Şifreyi al

                // "Zero" ve "ZeroZero" ana admin bilgilerini kaydetmeye karşı koruma
                if ($klncad !== "Zero" && $klncsfr !== "ZeroZero") {
                    $kaydet1 = $db->prepare("INSERT INTO `admins`(`ad`, `sifre`) VALUES (:ad, :sifre)");  // Admin eklemek için sorgu hazırla
                    $kaydet1->bindParam(":ad", $klncad, PDO::PARAM_STR);  // Parametreleri bağla
                    $kaydet1->bindParam(":sifre", $klncsfr, PDO::PARAM_STR);
                    $ekle1 = $kaydet1->execute();  // Veritabanına ekle
                    if ($ekle1) {
                        echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";  // Sayfayı yenileyerek işlemi güncelle
                    }
                }
            }

            // Admin Silme İşlemi
            if (isset($_POST["Sil"])) {
                $klncad = trim($_POST["ad"]);  // Kullanıcı adını al
                $klncsfr = trim($_POST["sifre"]);  // Şifreyi al

                // "Zero" ve "ZeroZero" ana adminin silinmesini engelleme
                if($klncad !== "Zero" ){
                    $sl1 = $db->prepare('DELETE FROM `admins` WHERE ad = :ad');  // Admini silmek için sorgu hazırla
                    $sl1->bindParam(":ad", $klncad, PDO::PARAM_STR);  // Kullanıcı adını parametre olarak bağla
                    $sifir1 = $sl1->execute();  // Admini veritabanından sil
                    if ($sifir1) {
                        echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";  // Sayfayı yenileyerek işlemi güncelle
                    }
                }
                else if ($klncad == "Zero" && $klncsfr == "ZeroZero") {
                    // Ana admini silmeye çalıştıysa uyarı ver
                    echo "<script type='text/javascript'>alert('Ana Admini Silme İşlemi Denemeniz Başarısız Bunu Yapamazsınız!!');</script>";
                    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                }
            }
        ?>

        <h1>Admin Tablosu</h1>
        <table border="1">
            <tr>
                <th>Sıra</th><th>Kullanıcı Adı</th><th>Şifre</th>  <!-- Tablo başlıkları -->
            </tr>
            <?php
            $sira = 0;
                // Adminler tablosundaki tüm verileri çekip tabloya yazdırıyoruz
                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$sira++."</td>";  // Sıra numarasını yazdır
                    echo "<td>".$satir["ad"]."</td>";  // Kullanıcı adını yazdır
                    echo "<td>".$satir["sifre"]."</td>";  // Şifreyi yazdır
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
