<!-- Form Elements -->
<div class="panel panel-default">
    <div class="panel-heading">
        Tambah Data Buku
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h3>Masukkan Informasi Buku</h3>
                <br>
                <form method="POST">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul" />
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" />
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" />
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun">
                            <?php
                            $tahun = date("Y");

                            for ($i = $tahun - 29; $i <= $tahun; $i++) {
                                echo '
                                        <option value="' . $i . '">' . $i . '</option>
                                    ';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah" />
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi">
                            <option value="rak1">Rak 1</option>
                            <option value="rak2">Rak 2</option>
                            <option value="rak3">Rak 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" name="tanggal" type="date" />
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
    $tahun = $_POST['tahun'];
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];

    // Prepare statement
    $stmt = $koneksi->prepare("INSERT INTO tb_buku (judul, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, lokasi, tgl_input)VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssss", $judul, $pengarang, $penerbit, $tahun, $isbn, $jumlah, $lokasi, $tanggal);

    // Execute statement
    if ($stmt->execute()) {
        ?>
        <script type="text/javascript">
            alert("Data Berhasil Diinput");
            window.location.href="?page=buku";
        </script>
        <?php
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>
