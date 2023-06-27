<?php
    $id_trx = $_GET['id_trx'];
    $id = $_GET['id'];
    $tgl_kembali = $_GET['tgl_kembali'];
    $lambat = $_GET['lambat'];    

    if ($lambat > 7){
        ?>
            <script type="text/javascript">
                alert("Peminjaman Buku Tidak Dapat Diperpanjang, Karena Lebih dari 7 Hari... Kembalikan Dahulu Kemudian Pinjam Kembali");
                window.location.href="?page=transaksi";
            </script>
        <?php
    }else {
        $pecah_tgl_kembali = explode("-", $tgl_kembali);
        $next_7_hari = mktime(0,0,0, $pecah_tgl_kembali[1], $pecah_tgl_kembali[2]+7, $pecah_tgl_kembali[0]);
        $hari_next = date("d-m-Y", $next_7_hari);

        $sql = $koneksi->query("UPDATE tb_transaksi SET tgl_kembali ='$hari_next' WHERE id_trx=$id_trx");

        if ($sql) {
            ?>
                <script type="text/javascript">
                    alert("Perpanjangan Berhasil");
                    window.location.href="?page=transaksi";
                </script>
            <?php
        }else {
            ?>
                <script type="text/javascript">
                    alert("Perpanjangan Gagal");
                    window.location.href="?page=transaksi";
                </script>
            <?php
        }
    }
?>