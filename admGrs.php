<?php
session_start();
include "baglanti.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Admin Giriş</title>
    <link rel="stylesheet" href="admGrs.css">
</head>
<body>
    <div class="navbar">
        <a href="Tekno.php"><img src="img/Logo.png" alt="" style="height:100px;"></a>
        <ul>
            <li><a href="Tekno.php">Geri Dön</a></li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="post">
            <?php
                if (isset($_POST["Giris"])) {
                    $ad = trim($_POST["ad"]);
                    $sifre = trim($_POST["sifre"]);
                    $sql = "SELECT * FROM admins WHERE ad = ? AND sifre = ?";
                    $clst = $db->prepare($sql);
                    $clst->execute([$ad, $sifre]);

                    if ($clst->rowCount() > 0) {
                        $_SESSION["admin_giris"] = true;
                        header("Location: admin.php");
                        exit();
                    } else {
                        echo "<h1 style='color: red;'>HATALI GİRİŞ! KULLANICI ADI VEYA ŞİFRE YANLIŞ</h1>";
                    }
                }
            ?>
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
