<?php
session_start();
session_destroy();
echo "<script>alert('Anda telah keluar.'); window.location.replace('form_login.php');</script>";
?>