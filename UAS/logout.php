<?php
session_start(); // Mulai sesi

// Hapus semua variabel sesi
unset($_SESSION);

// Hapus sesi
session_destroy();
echo "<script>
alert ('Anda Berhasil Logout');
window.location = 'login.php';
</script>";   
exit;
?>