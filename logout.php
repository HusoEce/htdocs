<?php
session_start(); // Oturum başlatılır
session_unset(); // Oturumdaki tüm değişkenler sıfırlanır
session_destroy(); // Oturum tamamen yok edilir
header("Location: admGrs.php"); // Kullanıcı admin giriş sayfasına yönlendirilir
exit(); // Yönlendirme işlemi tamamlandıktan sonra script durdurulur
?>
