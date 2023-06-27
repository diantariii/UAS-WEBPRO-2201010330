<!-- Form Elements -->
<div class="panel panel-default">
  <div class="panel-heading">
    Tambah Data Anggota
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <h3>Masukkan Data Anggota</h3>
        <br>
        <form method="POST">
          <div class="form-group">
            <label>NIM</label>
            <input class="form-control" name="nim" />
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" name="nama" />
          </div>
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input class="form-control" name="tmpt_lahir" />
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input class="form-control" type="date" name="tgl_lahir" />
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label><br>
            <label class="checkbox-inline">
              <input type="radio" name="jk" value="L" /> L </label>
            <label class="checkbox-inline">
              <input type="radio" name="jk" value="P" /> P </label>
          </div>

          <div class="form-group">
            <label>Program Studi</label>
            <select class="form-control" name="prodi">
              <option>Teknik Informatika</option>
              <option>Sistem Komputer</option>
              <option>Akuntansi</option>
              <option>Manajemen</option>
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
  $stmt = $koneksi->prepare("INSERT INTO tb_anggota (nim, nama, tempat_lahir, tanggal_lahir, jk, prodi) VALUES (?, ?, ?, ?, ?, ?)");

  // Bind parameters
  $stmt->bind_param("ssssss", $nim, $nama, $tmpt_lahir, $tgl_lahir, $jk, $prodi);

  // Execute statement
  if ($stmt->execute()) {
    ?>
    <script type="text/javascript">
      alert("Data Berhasil Diinput");
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
