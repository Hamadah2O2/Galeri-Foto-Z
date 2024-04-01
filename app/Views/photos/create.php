<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Foto</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('photos/aksi_create') ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="judul" class="form-control mb-2" id="judul" placeholder="Judul" required>
                <textarea name="deskripsi" id="deskripsi" class="form-control mb-2" cols="30" rows="10" placeholder="Deskripsi" required></textarea>
                <!-- <input type="text" name="album_id" class="form-control mb-2" id="album_id" placeholder="Album"> -->
                <select class="form-select mb-2" name="album_id" id="album_id">
                    <option value="">---</option>
                    <?php foreach($album as $al): ?>
                        <option value="<?= $al['id'] ?>"><?= $al['nama'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="file" name="gambar" class="form-control mb-2" id="gambar" placeholder="Gambar" required>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('photos/myphotos') ?>" class="btn btn-warning">Kembali</a>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>