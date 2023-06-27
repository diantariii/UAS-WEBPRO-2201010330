<?php
$id = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM tb_buku WHERE id='$id'");
$tampil = $sql->fetch_assoc();
$tahun_terbit = $tampil['tahun_terbit'];
?>

<!-- Form Elements -->
<div class="panel panel-default">
    <div class="panel-heading">
        Ubah Data Buku
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h3>Masukkan Informasi Buku</h3>
                <br>
                <form method="POST">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul" value="<?php echo $tampil['judul']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" value="<?php echo $tampil['pengarang']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" value="<?php echo $tampil['penerbit']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun">
                            <?php
                            $tahun_sekarang = date("Y");
                            for ($i = $tahun_sekarang - 29; $i <= $tahun_sekarang; $i++) {
                                if ($tahun_terbit == $i) {
                                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                } else {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" value="<?php echo $tampil['isbn']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah" value="<?php echo $tampil['jumlah_buku']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi">
                            <option value="rak1" <?php if ($tampil['lokasi'] == 'rak1') echo 'selected'; ?>>Rak 1</option>
                            <option value="rak2" <?php if ($tampil['lokasi'] == 'rak2') echo 'selected'; ?>>Rak 2</option>
                            <option value="rak3" <?php if ($tampil['lokasi'] == 'rak3') echo 'selected'; ?>>Rak 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" name="tanggal" type="date" value="<?php echo $tampil['tgl_input']; ?>" />
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
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun'];
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];

    // Prepare statement
    $stmt = $koneksi->prepare("UPDATE tb_buku SET judul=?, pengarang=?, penerbit=?, tahun_terbit=?, isbn=?, jumlah_buku=?, lokasi=?, tgl_input=? WHERE id=?");

    // Bind parameters
    $stmt->bind_param("ssssssssi", $judul, $pengarang, $penerbit, $tahun_terbit, $isbn, $jumlah, $lokasi, $tanggal, $id);

    // Execute statement
    if ($stmt->execute()) {
        ?>
        <script type="text/javascript">
            alert("Edit Berhasil Disimpan");
            window.location.href = "?page=buku";
        </script>
        <?php
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>
