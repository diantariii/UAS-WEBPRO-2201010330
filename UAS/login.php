<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Halaman Login</title>
</head>
<body>

<?php
session_start();
if (isset($_SESSION['nama'])) {
  header('Location: index.php');
}
include "koneksi.php";
?>
<h1 align="center">Perpustakaan Berbasis Web</h1>
<div class="login-page">
  <div class="form">
  <form action="" method="POST" class="">
      <h2>Login</h2>
      <input type="text" placeholder="nama" name="nama"/>
      <input type="password" placeholder="password" name="password"/>
      <br>
      <br>
      <button type="submit" class="btn btn-primary" name="login">Sign in</button>
    </form>
  </div>
</div>

<?php
if(isset($_POST['login'])){
  $sql = mysqli_query ($koneksi, "SELECT * FROM petugas WHERE nama = '$_POST[nama]' AND password = '$_POST[password]'");

  $cek = mysqli_num_rows($sql);
  if($cek > 0){
      $_SESSION['nama'] = $_POST['nama'];
      echo "<script>
      alert ('Anda Berhasil Login');
      window.location = 'index.php';
      </script>";
  }else{
    echo "<script>
    alert ('Nama atau Password Anda Salah');
    window.location = 'login.php';
    </script>";
  }
}

?> 

</body>
</html>