<?php
session_start();
session_unset();
session_destroy();
header("Location: admGrs.php");
exit();
?>
