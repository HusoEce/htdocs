<?php
// MySQL Bağlantı Parametreleri
$host = 'localhost';
$user = 'root';
$password = '';  // Varsayılan XAMPP şifresi boş
$dbname = 'tekno';  // Kendi veritabanınızın adını yazın
$port = 3307;

// Bağlantı oluşturma
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Yayın Adı Seçimi
// Fotoğraf Seçimi (downloaded_images klasöründeki tüm fotoğraflar)
$foto_klasor = 'img/';
$foto_dosyalari = scandir($foto_klasor);  // Klasördeki dosyaları al
$foto_dosyalari = array_diff($foto_dosyalari, array('.', '..'));  // . ve .. dosyalarını kaldır

// Sayaç
$counter = 0;

// Her bir fotoğraf için döngü
foreach ($foto_dosyalari as $foto_isim) {
    // Fotoğraf ismini kitap adı olarak düzenleme
    $kitapadi_raw = pathinfo($foto_isim, PATHINFO_FILENAME);  // Fotoğraf ismini al (uzantı hariç)
    $kitapadi = str_replace('-', ' ', $kitapadi_raw);  // "-" yerine boşluk
    $kitapadi = ucwords($kitapadi);  // İlk harfleri büyük yapma

    // Fiyat Seçimi (120 ile 300 arasında ve sonu 0 olacak)
    $fiyat = rand(50, 600) * 10;  // 120-300 arasında bir değer üretir
    $miktar = rand(1, 10) * 10;  // 120-300 arasında bir değer üretir

    // SQL sorgusu ile veriyi ekleme
    $sql = "INSERT INTO urunler (isim, fiyat, miktar, gorsel) 
            VALUES ('$kitapadi', '$fiyat', '$miktar', '$foto_isim')";

    if ($conn->query($sql) === TRUE) {
        echo "Yeni ürün başarıyla eklendi: $kitapadi<br>";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>