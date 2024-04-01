<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="mt-2">
    <div class="container">
        <?= $this->include('part/alert') ?>
    </div>
    <div class="container-fluid mt-4 mb-3">
        <a href="<?= base_url("album/create") ?>" class="btn btn-success">Tambah Album</a>
    </div>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
            <?php foreach ($album as $l) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $l['nama'] ?></td>
                    <td><?= $l['deskripsi'] ?></td>
                    <td><?= $l['tanggal_dibuat'] ?></td>
                    <td>
                        <a href="<?= base_url("album/detail/".$l['id']) ?>" class="btn btn-warning">Detail</a>
                        <a href="<?= base_url("album/edit/".$l['id']) ?>" class="btn btn-primary">Edit</a>
                        <a href="<?= base_url("album/delete/".$l['id']) ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
    </div>
</div>
<div class="m-5"></div>
<?= $this->endSection() ?>