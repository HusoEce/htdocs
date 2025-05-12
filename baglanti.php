<?php
    // Veritabanı bağlantı ayarları
    $host = "localhost"; // Veritabanı sunucusunun adresi
    $dbname = "tekno"; // Bağlantı sağlanacak veritabanı adı
    $username = "root"; // Veritabanı kullanıcı adı
    $password = ""; // Veritabanı şifresi (boş olmalı yerel geliştirme ortamında)

    try {
        // PDO ile veritabanı bağlantısını oluşturma
        $db = new PDO("mysql:host=$host; port=3307; dbname=$dbname;", $username, $password);
        // Hata modunu istisna (exception) olarak ayarlama
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        // Hata durumunda yapılacak işlem
        // Hata yakalanıp hiçbir şey yapılmaz, bu kısmı geliştirme aşamasında hata mesajlarını yazdırmak için kullanabilirsiniz.
    }
?>
