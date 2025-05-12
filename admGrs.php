<?php
session_start(); // Oturum başlatılır, admin girişi kontrolü için oturum kullanılacak.
include "baglanti.php"; // Veritabanı bağlantısı yapılır.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Admin Giriş</title>
    <link rel="stylesheet" href="admGrs.css"> <!-- Admin giriş sayfası için stil dosyası ekleniyor. -->
    <link rel="shortcut icon" href="img/logos/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Navigasyon menüsü -->
    <div class="navbar">
        <a href="Tekno.php"><img src="img/logos/Logo.png" alt="" style="height:100px;"></a> <!-- Logo -->
        <ul>
            <li><a href="Tekno.php">Geri Dön</a></li> <!-- Tekno.php sayfasına geri dönme bağlantısı -->
        </ul>
    </div>
    <div class="container">
        <form action="" method="post"> <!-- Kullanıcı giriş formu başlatılır. -->
            <?php
                // Form gönderildiğinde giriş kontrolü yapılır.
                if (isset($_POST["Giris"])) {
                    $ad = trim($_POST["ad"]); // Kullanıcı adı alınır ve baştaki/sondaki boşluklar temizlenir.
                    $sifre = trim($_POST["sifre"]); // Şifre alınır ve baştaki/sondaki boşluklar temizlenir.
                    // Adminler tablosunda kullanıcı adı ve şifre eşleşmesi kontrol edilir.
                    $sql = "SELECT * FROM admins WHERE ad = ? AND sifre = ?";
                    $birsey = $db->prepare($sql);
                    $birsey->execute([$ad, $sifre]);

                    // Eğer eşleşen bir admin varsa, giriş başarılı kabul edilir.
                    if ($birsey->rowCount() > 0) {
                        $_SESSION["admin_giris"] = true; // Oturum başlatılır.
                        header("Location: admin.php"); // Yönetici paneline yönlendirilir.
                        exit();
                    } else {
                        // Hatalı giriş yapılmışsa, kullanıcıya uyarı mesajı gösterilir.
                        echo "<h1 style='color: red;'>HATALI GİRİŞ! KULLANICI ADI VEYA ŞİFRE YANLIŞ</h1>";
                    }
                }
            ?>
            <!-- Giriş formu -->
            <table>
                <tr>
                    <td style="height: 300px; width: 500px; font-size:50px;">Kullanıcı Adı:</td>
                    <td><input type="text" name="ad" style="height: 300px; width: 500px; border-radius:100px; font-size:100px;"></td>
                </tr>
                <tr>
                    <td style="height: 300px; width: 500px; font-size:50px;">Şifre:</td>
                    <td><input type="password" name="sifre" minlength="8" maxlength="25" style="height: 300px; width: 500px; border-radius:100px; font-size:100px;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center; padding-top: 10px;" class="grs">
                        <input type="submit" value="Giriş" name="Giris" style="height:100px; width:200px; font-size:50px; border-radius:40px;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
