<?php
$tgl_pinjam = date('d-m-Y');
$tujuh_hari = mktime(0, 0, 0, date("n"), date("j") + 7, date('Y'));
$kembali = date('d-m-Y', $tujuh_hari);
?>

<!-- Form Elements -->
<div class="panel panel-default">
  <div class="panel-heading">
    Tambah Data Transaksi
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <h3>Masukkan Transaksi</h3>
        <br>
        <form method="POST" onsubmit="return validasi(this)">
          <div class="form-group">
            <label>Judul Buku</label>
            <select class="form-control" name="buku">
              <?php
              $sql = $koneksi->query("SELECT * FROM tb_buku ORDER BY id");

              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id].$data[judul]'>$data[judul]</option>";
              }
              ?>

            </select>
          </div>
          <div class="form-group">
            <label>Nama Anggota</label>
            <select class="form-control" name="nama">
              <?php
              $sql = $koneksi->query("SELECT* FROM tb_anggota ORDER BY nim");

              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[nim].$data[nama]'>$data[nim].$data[nama]</option>";
              }
              ?>
            </select>
          </div>
          <div>
            <div class="form-group">
              <label>Tanggal Pinjam</label>
              <input class="form-control" type="text" name="tgl_pinjam" id="tgl" value="<?php echo $tgl_pinjam; ?>"
                readonly />
            </div>
            <div class="form-group">
              <label>Tanggal Kembali</label>
              <input class="form-control" type="text" name="tgl_kembali" id="tgl" value="<?php echo $kembali; ?>"
                readonly />
            </div>
          </div>
          <div>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['simpan'])) {

  $tgl_pinjam = $_POST['tgl_pinjam'];
  $tgl_kembali = $_POST['tgl_kembali'];

  $buku = $_POST['buku'];
  $pecah_buku = explode(".", $buku);
  $id = $pecah_buku[0];
  $judul = $pecah_buku[1];

  $nama = $_POST['nama'];
  $pecah_nama = explode(".", $nama);
  $nim = $pecah_nama[0];
  $nama = $pecah_nama[1];

  $sql = $koneksi->query("SELECT * FROM tb_buku WHERE judul = '$judul'");
  while ($data = $sql->fetch_assoc()) {
      $sisa = $data['jumlah_buku'];
  
      if ($sisa == 0) {
          ?>
          <script type="text/javascript">
              alert("Stok Buku Habis, Transaksi Tidak Dapat Dilakukan, Silahkan Tambah Stok Buku");
              window.location.href = "?page=transaksi&aksi=tambah";
          </script>
          <?php
      } else {
          // Kurangi stok buku
          $sisa = $sisa - 1;
  
          // Update stok buku di tabel tb_buku
          $updateStok = $koneksi->query("UPDATE tb_buku SET jumlah_buku = '$sisa' WHERE judul = '$judul'");
  
          if ($updateStok) {
              // Prepare statement
              $stmt = $koneksi->prepare("INSERT INTO tb_transaksi (nim, nama, judul, tgl_pinjam, tgl_kembali, status) VALUES (?, ?, ?, ?, ?, 'pinjam')");
  
              // Bind parameters
              $stmt->bind_param("sssss", $nim, $nama, $judul, $tgl_pinjam, $tgl_kembali);
  
              // Execute statement
              if ($stmt->execute()) {
                  ?>
                  <script type="text/javascript">
                      alert("Data Berhasil Diinput");
                      window.location.href = "?page=transaksi";
                  </script>
                  <?php
              } else {
                  echo "Error: " . $stmt->error;
              }
  
              // Close statement
              $stmt->close();
          } else {
              echo "Error updating stock: " . $koneksi->error;
          }
      }
  }
}
?>  