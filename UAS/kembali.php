<?php
$id_trx = $_GET['id_trx'];
$id = $_GET['judul'];

$sql = $koneksi->query("UPDATE tb_transaksi SET status='kembali' WHERE id_trx='$id_trx'");

$sql_buku = $koneksi->query("UPDATE tb_buku SET jumlah_buku = jumlah_buku + 1 WHERE judul='$id'");

if ($sql_buku) {
    ?>/
    <script type="text/javascript">
        alert("Proses Pengembalian Buku Berhasil");
        window.location.href="?page=transaksi";
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Terjadi kesalahan saat mengupdate jumlah buku");
        window.location.href="?page=transaksi";
    </script>
    <?php
}
?>
