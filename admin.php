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
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" href="img/logos/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="navbar">
        <a href="#"><img src="img/logos/Logo.png" alt="" style="height:100px;"></a>
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
            </table><br>
            <table style="margin-left:30px;">
                <tr><th colspan="2" style="font-size:60px;">Ürün Silme</th></tr>
                <tr><td>Sıra No :</td><td><input type="text" name="sira" style="width:150px; font-size:40px;"></td></tr>
                <tr><td colspan="2"><input type="submit" name="siraya_gore_sil" value="Sil" style="width:150px; font-size:40px;"></td></tr>
            </table>   
        </form><br>
        
        
        <?php
            if (isset($_POST["siraya_gore_sil"])) {
                $sira = $_POST["sira"];
                $sira = intval($sira);
                if ($sira > 0) {
                    $sorgu = $db->query("SELECT ID FROM urunler ORDER BY ID ASC");
                    $urunler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
                    $sira_index = $sira - 1;
                    if (isset($urunler[$sira_index])) {
                        $sil_id = $urunler[$sira_index]["ID"];
                        $sil = $db->prepare("DELETE FROM urunler WHERE ID = ?");
                        $sil->execute([$sil_id]);
                        echo "<script>window.location.href = window.location.href;</script>";
                    }
                }
            }
            // Eğer formdan 'siraya_gore_sil' butonuna tıklanmışsa
            // Formdan gelen sıra numarasını al
            // Sıra numarasını tam sayıya çevir
            // Eğer sıra 0'dan büyükse (geçerli bir değer girilmişse)
            // Veritabanındaki ürünleri ID'ye göre sırala ve getir
            // Gelen sonuçları dizi olarak al
            // Kullanıcının girdiği sıra, dizilerde 0'dan başladığı için 1 çıkarıyoruz
            // Eğer bu sıra gerçekten dizide varsa, yani o kadar ürün varsa
            // O sıraya denk gelen ürünün ID'sini al
            // Bu ID'ye sahip ürünü veritabanından sil
            // Sayfayı yenileyerek tabloyu güncelle
        ?>

        <?php //Kaydet Ve Sıfırla
                if (isset($_POST["Kaydet"])) {
                    $isim = trim($_POST["isim"]);
                    $fiyat = trim($_POST["Fiyat"]);
                    $miktar = trim($_POST["Miktar"]);
                    $gorsel = trim($_POST["gorsel"]);
                    if($isim !== "" && $fiyat !== "" && $miktar !== "" && $gorsel !== ""){
                        $kaydet = $db->prepare("INSERT INTO `urunler`(`ID`, `isim`, `miktar`, `fiyat`, `gorsel`) VALUES (NULL, :isim, :miktar, :fiyat, :gorsel)");
                        $kaydet->bindParam(":isim", $isim, PDO::PARAM_STR);
                        $kaydet->bindParam(":fiyat", $fiyat, PDO::PARAM_STR);
                        $kaydet->bindParam(":miktar", $miktar, PDO::PARAM_INT);
                        $kaydet->bindParam(":gorsel", $gorsel, PDO::PARAM_STR);
                        $ekle = $kaydet->execute();
                        if ($ekle) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
                    }
                }
            if (isset($_POST["Sifirla"])) {
                $sifirla = $db->prepare("TRUNCATE TABLE urunler; ALTER TABLE urunler AUTO_INCREMENT = 1;");
                $sifir = $sifirla->execute();
                if ($sifir) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
            }
        ?>
        <?php
            if (isset($_POST["verileri_getir"])){
                $id = $_POST["guncellenecek_id"];
                $sorgu = $db->prepare("SELECT * FROM urunler WHERE ID = ?");
                $sorgu->execute([$id]);
                $urun = $sorgu->fetch(PDO::FETCH_ASSOC);
            }
        ?>
        <?php if (isset($_POST["verileri_getir"])) { ?>
            <div class="dnm">
                <form method="post">
                    <h1>Ürün Güncelle</h1>
                    <hr>
                    <input type="text" name="isim" value="<?= $urun['isim'] ?>" placeholder="Ürün Adı"><br>
                    <input type="text" name="Fiyat" value="<?= $urun['fiyat'] ?>" placeholder="Fiyat"><br>
                    <input type="text" name="Miktar" value="<?= $urun['miktar'] ?>" placeholder="Miktar"><br>
                    <input type="text" name="gorsel" value="<?= $urun['gorsel'] ?>" placeholder="Foto URL"><br>
                    <input type="hidden" name="guncellenecek_id" value="<?= $urun['ID'] ?>">
                    <input type="submit" name="guncelle" value="Güncellemeyi Kaydet">
                </form>
            </div>
        <?php }?>
        <?php
            $db = new PDO("mysql:host=localhost;port=3307;dbname=tekno;charset=utf8", "root", "");
            if (isset($_POST["guncelle"])) {
                $id = $_POST["guncellenecek_id"];  
                $isim = $_POST["isim"];             
                $fiyat = $_POST["Fiyat"];          
                $miktar = $_POST["Miktar"];         
                $gorsel = $_POST["gorsel"];            
                $guncelle = $db->prepare("UPDATE urunler SET isim = ?, fiyat = ?, miktar = ?, gorsel = ? WHERE ID = ?");
                $guncelle->execute([$isim, $fiyat, $miktar, $gorsel, $id]);
                echo "<script>window.location.href = window.location.href;</script>";  
            }
            // Veritabanı bağlantısı
            // Ürün güncelleme işlemi
            // Ürünün ID'sini al
            // Güncellenmiş isimi al
            // Güncellenmiş fiyatı al
            // Güncellenmiş miktarı al
            // Güncellenmiş görsel URL'sini al
            // Güncellenmiş kategoriyi al
            // Veritabanına güncelleme sorgusunu gönder
            // Sayfayı yenileyerek güncellemeyi gör
            // Ürünleri listelerken her ürüne güncelle butonu ekle
        ?>
        <h1>Ürünler Tablosu</h1>
        <table border="1">
            <tr>
                <th>Sıra</th><th>İsim</th><th>Fiyat</th><th>Miktar</th><th>Foto</th><th>Güncelle</th>
            </tr>

            <?php
            $sira = 1;
            $sorgu = $db->query("SELECT * FROM urunler");
            while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$sira++."</td>";
                echo "<td>".$satir["isim"]."</td>";
                echo "<td>".$satir["fiyat"]."</td>";
                echo "<td>".$satir["miktar"]."</td>";
                echo "<td><img src='img/".$satir["gorsel"]."' style='height:100px;'></td>";
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='guncellenecek_id' value='".$satir["ID"]."'>
                            <input type='submit' name='verileri_getir' value='Güncelle' style='width:120px; height:120px; font-size:25px; border-radius:50px;'>
                        </form>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>