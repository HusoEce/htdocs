<?php
    // Veritabanı bağlantısını dahil ediyoruz
    include "baglanti.php";
    
    // Ürünleri çekmek için SQL sorgusunu yazıyoruz
    $sql = "SELECT * FROM urunler";
    $sorgu = $db -> query($sql); // Veritabanından tüm ürünleri alıyoruz
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoCastle - Mağza</title>
    <link rel="stylesheet" href="Tekno.css"> <!-- CSS dosyasını dahil ediyoruz -->
    <link rel="shortcut icon" href="img/logos/favicon.ico" type="image/x-icon"> <!-- Favicon ekliyoruz -->
</head>
<body>
    <div class="navbar"> <!-- Navigasyon menüsü -->
        <a href="Tekno.php"><img src="img/logos/Logo.png" alt="" style="height:100px;"></a> <!-- Logo ekliyoruz -->
        <ul>
            <li><a href="admGrs.php">Admin Giriş Yap</a></li> <!-- Admin giriş linki -->
        </ul>
    </div>
    <h1 style="margin-left:43%; font-size:40pt;">Hoşgeldiniz</h1><br> <!-- Başlık ekliyoruz -->
    
    <div class="container"> <!-- Ana içerik alanı -->
        <div class="filtre-alani"> <!-- Arama filtresi alanı -->
            <form method="get"> <!-- Form gönderimi GET yöntemiyle yapılıyor -->
                <input type="text" name="arama" placeholder="İsim ara"> <!-- Arama alanı -->
                <button type="submit">Uygula</button> <!-- Arama butonu -->
                <?php
                    // Veritabanı bağlantısını tekrar dahil ediyoruz
                    include "baglanti.php";
                    
                    // Başlangıçta boş olan sorgu şartı
                    $kosul = "";
                    
                    // Eğer kullanıcı arama yapmışsa
                    if (isset($_GET["arama"]) && !empty(trim($_GET["arama"]))) {
                        $aranan = trim($_GET["arama"]); // Kullanıcının aradığı değeri alıyoruz
                        $kosul = "WHERE isim LIKE :aranan"; // Arama koşulunu ekliyoruz
                        // Veritabanında arama yapacak sorguyu hazırlıyoruz
                        $sorgu = $db->prepare("SELECT * FROM urunler $kosul");
                        // Arama parametresini bağlıyoruz
                        $sorgu->bindValue(":aranan", "%$aranan%", PDO::PARAM_STR);
                        $sorgu->execute(); // Sorguyu çalıştırıyoruz
                    } 
                    else {
                        // Eğer arama yapılmamışsa tüm ürünleri getiriyoruz
                        $sorgu = $db->query("SELECT * FROM urunler");
                    }
                ?>
            </form>
        </div>
        
        <div class="urun-tablosu"> <!-- Ürünlerin görüntüleneceği alan -->
            <?php 
                // Veritabanından gelen ürünleri döngü ile ekliyoruz
                while ($urun = $sorgu->fetch(PDO::FETCH_ASSOC)) { 
            ?>
                <div class="urun-karti"> <!-- Her bir ürünün kartı -->
                    <h3><?php echo $urun["isim"]; ?></h3> <!-- Ürünün ismini yazdırıyoruz -->
                    <img src="<?php echo "img/".$urun["gorsel"]; ?>" style="height:190px;"> <!-- Ürünün görselini ekliyoruz -->
                    <p>Fiyat: <?php echo $urun["fiyat"]; ?>₺</p> <!-- Ürünün fiyatını yazdırıyoruz -->
                    <p>Stok: <?php echo $urun["miktar"]; ?></p> <!-- Ürünün stok miktarını yazdırıyoruz -->
                    
                    <form method="post"> <!-- Sepete ekleme formu -->
                        <input type="hidden" name="urun_id" value="<?php echo $urun["ID"]; ?>"> <!-- Ürün ID'sini gizli olarak gönderiyoruz -->
                        <button type="submit" name="sepeteEkle">Sepete Ekle</button> <!-- Sepete ekleme butonu -->
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
