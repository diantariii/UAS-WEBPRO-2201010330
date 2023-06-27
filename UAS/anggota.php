<a href="?page=anggota&aksi=tambah" class="btn btn-primary" style="margin-button: 5px">Tambah Data</a>

<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Anggota
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $sql = $koneksi->query("select * from tb_anggota");

                                while ($data = $sql->fetch_assoc()) {
                                    $jk = ($data['jk']=='L')?"Laki-Laki":"Perempuan";
                                
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nim']?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['tempat_lahir']; ?></td>
                                    <td><?php echo $data['tanggal_lahir']; ?></td>
                                    <td><?php echo $data['jk']; ?></td>
                                    <td><?php echo $data['prodi']; ?></td>
                                    <td>
                                        <a href="?page=anggota&aksi=edit&nim=<?php echo $data['nim']; ?>" class="btn btn-primary">Edit</a>
                                        <a onclick="return confirm('Anda Yakin Akan Menghapus Data Ini...?')" href="?page=anggota&aksi=hapus&nim=<?php echo $data['nim']; ?>" class="btn btn-danger">Hapus</a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>