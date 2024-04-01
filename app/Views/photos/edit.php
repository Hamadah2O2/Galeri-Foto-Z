<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Foto</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('photos/aksi_edit') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control mb-2" id="id" placeholder="id" value="<?= $photo['id'] ?>">
                <input type="text" name="judul" class="form-control mb-2" id="judul" placeholder="Judul" required value="<?= $photo['judul'] ?>">
                <textarea name="deskripsi" id="deskripsi" class="form-control mb-2" cols="30" rows="10" placeholder="Deskripsi" required><?= $photo['deskripsi'] ?></textarea>
                <!-- <input type="text" name="album_id" class="form-control mb-2" id="album_id" placeholder="Album"> -->
                <select class="form-select mb-2" name="album_id" id="album_id">
                    <option value="">---</option>
                    <?php foreach ($album as $al) : ?>
                        <option value="<?= $al['id'] ?>" <?= ($al['id'] == $photo['album_id']) ? 'selected' : '' ?>><?= $al['nama'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="row mb-2 justify-content-center align-items-center">
                    <div class="col-2">
                        <img src="<?= base_url('assets/img/' . $photo['lokasi_file']) ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-10">
                        <input type="file" name="gambar" class="form-control mb-2" id="gambar" placeholder="Gambar">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('photos/myphotos') ?>" class="btn btn-warning">Kembali</a>
                    <input type="submit" name="submit" value="Edit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>