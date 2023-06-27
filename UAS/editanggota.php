<?php
    $nim = $_GET['nim'];
    $sql = $koneksi->query("SELECT * FROM tb_anggota WHERE nim = '$nim'");
    $tampil = $sql->fetch_assoc();
?>

<!-- Form Elements -->
<div class="panel panel-default">
  <div class="panel-heading">
    Edit Data Anggota
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <h3>Masukkan Data Anggota</h3>
        <br>
        <form method="POST">
          <div class="form-group">
            <label>NIM</label>
            <input class="form-control" name="nim" value="<?php echo $tampil['nim']; ?>" readonly />
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" name="nama" value="<?php echo $tampil['nama']; ?>" />
          </div>
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input class="form-control" name="tmpt_lahir" value="<?php echo $tampil['tempat_lahir']; ?>" />
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $tampil['tanggal_lahir']; ?>" />
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label><br>
            <label class="checkbox-inline">
              <input type="radio" name="jk" value="L" <?php if ($tampil['jk'] == 'L') echo 'checked'; ?> /> L </label>
            <label class="checkbox-inline">
              <input type="radio" name="jk" value="P" <?php if ($tampil['jk'] == 'P') echo 'checked'; ?> /> P </label>
          </div>

          <div class="form-group">
            <label>Program Studi</label>
            <select class="form-control" name="prodi">
              <option <?php if ($tampil['prodi'] == 'Teknik Informatika') echo 'selected'; ?>>Teknik Informatika</option>
              <option <?php if ($tampil['prodi'] == 'Sistem Komputer') echo 'selected'; ?>>Sistem Komputer</option>
              <option <?php if ($tampil['prodi'] == 'Akuntansi') echo 'selected'; ?>>Akuntansi</option>
              <option <?php if ($tampil['prodi'] == 'Manajemen') echo 'selected'; ?>>Manajemen</option>
            </select><br>
            <div>
              <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['simpan'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $tmpt_lahir = $_POST['tmpt_lahir'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $jk = isset($_POST['jk']) ? $_POST['jk'] : null;
  $prodi = $_POST['prodi'];

  // Prepare statement
  $stmt = $koneksi->prepare("UPDATE tb_anggota SET nama=?, tempat_lahir=?, tanggal_lahir=?, jk=?, prodi=? WHERE nim=?");

  // Bind parameters
  $stmt->bind_param("ssssss", $nama, $tmpt_lahir, $tgl_lahir, $jk, $prodi, $nim);

  // Execute statement
  if ($stmt->execute()) {
    ?>
    <script type="text/javascript">
      alert("Edit Berhasil Disimpan");
      window.location.href = "?page=anggota";
    </script>
    <?php
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close statement
  $stmt->close();
}
?>
