<?php
    include "baglanti.php";
    $sql = "SELECT * FROM urunler";
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
        <div class="filtre-alani">
            <form method="get">
                <select name="sirala">
                    <option value="">Sırala</option>
                    <option value="az">A-Z</option>
                    <option value="za">Z-A</option>
                </select>
                <select name="kategori">
                    <option value="">Kategori</option>
                    <option value="Kablo">Kablo</option>
                    <option value="Klavye">Klavye</option>
                    <option value="Fare">Fare</option>
                </select>

                <input type="text" name="arama" placeholder="İsim ara">
                <button type="submit">Uygula</button>
                <?php
                    include "baglanti.php";
                    $kosul = "";
                    if (isset($_GET["arama"]) && !empty(trim($_GET["arama"]))) {
                        $aranan = trim($_GET["arama"]);
                        $kosul = "WHERE isim LIKE :aranan";
                        $sorgu = $db->prepare("SELECT * FROM urunler $kosul");
                        $sorgu->bindValue(":aranan", "%$aranan%", PDO::PARAM_STR);
                        $sorgu->execute();
                    } 
                    else {
                        $sorgu = $db->query("SELECT * FROM urunler");
                    }
                ?>
            </form>
        </div>
        <div class="urun-tablosu">
            <?php while ($urun = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="urun-karti">
                    <h3><?php echo $urun["isim"]; ?></h3>
                    <img src="<?php echo "img/".$urun["gorsel"]; ?>" style="height:190px;">
                    <p>Fiyat: <?php echo $urun["fiyat"]; ?>₺</p>
                    <p>Stok: <?php echo $urun["miktar"]; ?></p>
                    <form method="post">
                        <input type="hidden" name="urun_id" value="<?php echo $urun["ID"]; ?>">
                        <button type="submit" name="sepeteEkle">Sepete Ekle</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>