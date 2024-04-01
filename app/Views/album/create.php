<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Album</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('album/aksi_create') ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="nama" class="form-control mb-2" id="nama" placeholder="nama" required>
                <textarea name="deskripsi" id="deskripsi" class="form-control mb-2" cols="30" rows="10" placeholder="Deskripsi" required></textarea>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('album/') ?>" class="btn btn-warning">Kembali</a>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>