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
    <title>Ece</title>
</head>
<body>
    <h1>Ürünler</h1>

    <form action="" method="post">
        Ürün Adı : <input type="text" name="UrunAdi">
        Fiyat : <input type="text" name="Fiyat">
        Miktar : <input type="text" name="Miktar">
        Marka Adı : <input type="text" name="MarkaAdi">
        Açıklama : <input type="text" name="Aciklama">

        <input type="submit" value="Kaydet" name="UrunlerKaydet">
        <input type="submit" value="Sıfırla" name="UrunlerSifirla">
    </form>

    <?php
        if(isset($_POST["UrunlerKaydet"])){
            $UrunAdi = trim($_POST["UrunAdi"]);
            $Fiyat = trim($_POST["Fiyat"]);
            $Miktar = trim($_POST["Miktar"]);
            $MarkaAdi = trim($_POST["MarkaAdi"]);
            $Aciklama = trim($_POST["Aciklama"]);

            $kaydet1 = $db -> prepare("INSERT INTO Urunler (Id, UrunAdi, Fiyat, Miktar, MarkaAdi, Aciklama) VALUES (NULL, :UrunAdi, :Fiyat, :Miktar, :MarkaAdi, :Aciklama)");
            $kaydet1 -> bindParam(":UrunAdi", $UrunAdi, PDO::PARAM_STR);
            $kaydet1 -> bindParam(":Fiyat", $Fiyat, PDO::PARAM_INT);
            $kaydet1 -> bindParam(":Miktar", $Miktar, PDO::PARAM_INT);
            $kaydet1 -> bindParam(":MarkaAdi", $MarkaAdi, PDO::PARAM_STR);
            $kaydet1 -> bindParam(":Aciklama", $Aciklama, PDO::PARAM_STR);

            $ekle1 = $kaydet1 -> execute();
            if($ekle1) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
        }

        if(isset($_POST["UrunlerSifirla"])){
            $sifirla1 = $db -> prepare("TRUNCATE TABLE Urunler; ALTER TABLE Urunler AUTO_INCREMENT = 1;");
            $sifir1 = $sifirla1 -> execute();
            if($sifir1) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
        }
    ?>

    <h1>Kullanıcılar</h1>

    <form action="" method="post">
        Ad Soyad : <input type="text" name="AdSoyad">
        Eposta : <input type="text" name="Eposta">
        Tel No : <input type="text" name="Tel">
        Tc Kimlik No : <input type="text" name="TcKimlikNo">
        Adres : <input type="text" name="Adres">

        <input type="submit" value="Kaydet" name="KullanicilarKaydet">
        <input type="submit" value="Sıfırla" name="KullanicilarSifirla">
    </form>

    <?php
        if(isset($_POST["KullanicilarKaydet"])){
            $AdSoyad = trim($_POST["AdSoyad"]);
            $Eposta = trim($_POST["Eposta"]);
            $Tel = trim($_POST["Tel"]);
            $TcKimlikNo = trim($_POST["TcKimlikNo"]);
            $Adres = trim($_POST["Adres"]);

            $kaydet2 = $db -> prepare("INSERT INTO Kullanicilar (Id, AdSoyad, Eposta, Tel, TcKimlikNo, Adres) VALUES (NULL, :AdSoyad, :Eposta, :Tel, :TcKimlikNo, :Adres)");
            $kaydet2 -> bindParam(":AdSoyad", $AdSoyad, PDO::PARAM_STR);
            $kaydet2 -> bindParam(":Eposta", $Eposta, PDO::PARAM_INT);
            $kaydet2 -> bindParam(":Tel", $Tel, PDO::PARAM_INT);
            $kaydet2 -> bindParam(":TcKimlikNo", $TcKimlikNo, PDO::PARAM_STR);
            $kaydet2 -> bindParam(":Adres", $Adres, PDO::PARAM_STR);

            $ekle2 = $kaydet2 -> execute();
            if($ekle2) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
        }

        if(isset($_POST["KullanicilarSifirla"])){
            $sifirla2 = $db -> prepare("TRUNCATE TABLE Kullanicilar; ALTER TABLE Kullanicilar AUTO_INCREMENT = 1;");
            $sifir2 = $sifirla2 -> execute();
            if($sifir2) echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
        }
    ?>
</body>
</html>